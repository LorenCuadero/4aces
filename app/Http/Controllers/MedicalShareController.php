<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Mail\SendMedicalShareTransInfo;
use App\Models\MedicalShare;
use App\Models\Student;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Mail\SendDeletionNotificationMS;
use App\Services\StoreLogsService;

class MedicalShareController extends Controller
{
    public function medicalShare()
    {
        $students = Student::all();

        $batchYears = [];

        foreach ($students as $student) {
            if (!in_array($student->batch_year, $batchYears)) {
                $batchYears[] = $student->batch_year;
            }
        }

        $studentIdsWithMedicalShares = MedicalShare::distinct()->pluck('student_id')->toArray();
        $student_ms_records = Student::whereIn('id', $studentIdsWithMedicalShares)->get();
        $student_with_no_ms_records = Student::whereNotIn('id', $studentIdsWithMedicalShares)->get();

        $medicalShareRecords = MedicalShare::select('student_id', \DB::raw('SUM(total_cost) as total_due'), \DB::raw('SUM(amount_paid) as total_paid'))
            ->groupBy('student_id')
            ->get();

        $totalAmounts = [];
        foreach ($medicalShareRecords as $record) {
            $totalAmounts[$record->student_id] = [
                'amount_due' => $record->total_due * 0.15,
                'amount_paid' => $record->total_paid,
            ];
        }

        return view('pages.admin-auth.records.medical-share', [
            'students' => $students,
            'student_ms_records' => $student_ms_records,
            'totalAmounts' => $totalAmounts,
            'medicalShareRecords' => $medicalShareRecords,
            'student_with_no_ms_records' => $student_with_no_ms_records,
        ]);
    }

    public function studentMedicalShareRecords($id)
    {
        $student = Student::find($id);

        if (!$student) {
            return back()->with('error', 'Student not found!');
        }

        $medical_share_records = MedicalShare::where('student_id', $student->id)->get();

        return view('pages.admin-auth.records.student-medical-share', compact('student', 'medical_share_records'));
    }

    public function storeMedicalShare(Request $request, $id)
    {
        $validatedData = $request->validate([
            'medical_concern' => ['required', 'string', 'max:255'],
            'amount_due' => ['required'],
            'amount_paid' => ['required'],
            'date' => ['required', 'date'],
        ]);

        $medical_share = new MedicalShare();
        $medical_share->medical_concern = $validatedData['medical_concern'];
        $medical_share->total_cost = $validatedData['amount_due'];
        $percent_share = $validatedData['amount_due'] * 0.15;
        $medical_share->amount_paid = $validatedData['amount_paid'];
        $medical_share->date = $validatedData['date'];
        $medical_share->student_id = $id;
        $medical_share->save();

        $student = Student::find($id);
        $studentId = $student->id;
        $student_email = $student->email;
        $student_name = $student->first_name . ' ' . $student->last_name;
        $student_batch_year = $student->batch_year;

        // Log the action
        $action = "Added";
        StoreLogsService::storeLogs(auth()->user()->id, $action, "Medical Share", $studentId, null, $student_batch_year);

        Mail::to($student_email)->send(new SendMedicalShareTransInfo($student_name, $medical_share->medical_concern, $medical_share->total_cost, $percent_share, $medical_share->amount_paid, $medical_share->date));

        return back()->with('success-medical', 'Medical share record added and email sent successfully!', compact('medical_share'));
    }

    public function updateMedicalShare(Request $request, $id)
    {
        $validatedData = $request->validate([
            'medical_concern' => ['required', 'string', 'max:255'],
            'amount_due' => ['required', 'numeric'],
            'amount_paid' => ['required', 'numeric'],
            'date' => ['required', 'date'],
        ]);

        $medicalShare = MedicalShare::find(request()->input('medical_id'));
        $studentId = $medicalShare->student_id;
        $studentEmail = $medicalShare->student->email;
        $studentName = $medicalShare->student->first_name . " " . $medicalShare->student->last_name;
        $studentBatchYear = $medicalShare->student->batch_year;
        $medicalShare->medical_concern = $validatedData['medical_concern'];
        $medicalShare->total_cost = $validatedData['amount_due'];
        $percent_share = $validatedData['amount_due'] * 0.15;
        $medicalShare->amount_paid = $validatedData['amount_paid'];
        $medicalShare->date = $validatedData['date'];
        $medicalShare->student_id = $studentId;

        $medicalShare->save();

        // Log the action
        $action = "Updated";
        StoreLogsService::storeLogs(auth()->user()->id, $action, "Medical Share", $studentId, null, $studentBatchYear);

        // Send email notification to the student
        Mail::to($studentEmail)->send(new SendMedicalShareTransInfo($studentName, $medicalShare->medical_concern, $medicalShare->total_cost, $percent_share, $medicalShare->amount_paid, $medicalShare->date));

        // Return success message only if no duplicate was found
        return back()->with('success', 'Medical share record updated and email sent successfully!', compact('medicalShare'));
    }

    public function deleteMedicalShare($id)
    {
        $medicalShare = MedicalShare::find($id);

        if (!$medicalShare) {
            return back()->with('error', 'personal cash advance record not found.');
        }

        // Store student information before deletion
        $studentName = $medicalShare->student->first_name . ' ' . $medicalShare->student->last_name;
        $studentEmail = $medicalShare->student->email;
        $studentId = $medicalShare->student->id;
        $amountDue = $medicalShare->total_cost * 0.15;
        $amountPaid = $medicalShare->amount_paid;
        $date = $medicalShare->date;

        // Log the action
        $action = "Deleted";
        StoreLogsService::storeLogs(auth()->user()->id, $action, "Medical Share", $studentId, null, $medicalShare->student->batch_year);

        Mail::to($studentEmail)->send(new SendDeletionNotificationMS($studentName, $amountDue, $amountPaid, $date));

        $medicalShare->delete();

        // Return success message
        return back()->with('success', 'Medical share record deleted and email sent successfully!.');
    }
}
