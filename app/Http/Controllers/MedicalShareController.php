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
use Illuminate\Support\Facades\Auth;

class MedicalShareController extends Controller {
    public function medicalShare() {
        if(Auth::user()->role != '2') {
            return redirect()->back()->with('error', 'You do not have permission to access this page');
        }

        $students = Student::all();

        $batchYears = [];

        foreach($students as $student) {
            if(!in_array($student->batch_year, $batchYears)) {
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
        foreach($medicalShareRecords as $record) {
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

    public function studentMedicalShareRecords($id) {
        if(Auth::user()->role != '2') {
            return redirect()->back()->with('error', 'You do not have permission to access this page');
        }

        $student = Student::find($id);

        if(!$student) {
            return back()->with('error', 'Student not found!');
        }

        $acknowledgementReceipt = null;
        $successMS = 0;
        $successMSUpdate = 0;
        $medical_share_records = MedicalShare::where('student_id', $student->id)->get();

        return view('pages.admin-auth.records.student-medical-share', compact('student', 'medical_share_records', 'acknowledgementReceipt', 'successMS', 'successMSUpdate'));
    }

    public function storeMedicalShare(Request $request, $id) {
        if(Auth::user()->role != '2') {
            return redirect()->back()->with('error', 'You do not have permission to access this page');
        }

        $validatedData = $request->validate([
            'medical_concern' => ['required', 'string', 'max:255'],
            'amount_due' => ['required'],
            'amount_paid' => ['nullable'],
            'date' => ['required', 'date'],
        ]);

        $send_amount_due_only = 0;
        if($request->has('send_amount_due_only_medical')) {
            $send_amount_due_only = 1;
        }

        $acknowledgementReceipt = 0;
        if($request->has('print_acknowledegement_receipt_medical')) {
            $acknowledgementReceipt = 1;
        }

        $dateOfTransaction = $validatedData['date'];
        $amountPaid = $validatedData['amount_paid'];
        $amountPaidInWords = StoreLogsService::numberToWords($validatedData['amount_paid']);
        $category = "Medical Share";

        $amount = 0;
        if ($amountPaid == null) {
            $amount = 0;
        }
        if ($amountPaid != null) {
            $amount = $amountPaid;
        }

        $medical_share = new MedicalShare();
        $medical_share->medical_concern = $validatedData['medical_concern'];
        $medical_share->total_cost = $validatedData['amount_due'];
        $percent_share = $validatedData['amount_due'] * 0.15;
        $medical_share->amount_paid = $amount;
        $medical_share->date = $dateOfTransaction;
        $medical_share->student_id = $id;
        $medical_share->save();

        $student = Student::findOrFail($id);
        $studentId = $student->id;
        $student_email = $student->email;
        $student_name = $student->first_name.' '.$student->last_name;
        $student_batch_year = $student->batch_year;

        // Log the action
        $action = "Added";
        StoreLogsService::storeLogs(auth()->user()->id, $action, "Medical Share", $studentId, null, $student_batch_year);

        Mail::to($student_email)->send(new SendMedicalShareTransInfo($student_name, $medical_share->medical_concern, $medical_share->total_cost, $percent_share, $medical_share->amount_paid, $medical_share->date, $send_amount_due_only
        ));

        $medical_share_records = MedicalShare::where('student_id', $student->id)->get();
        $successMS = 1;
        $successMSUpdate = 0;

        return view('pages.admin-auth.records.student-medical-share', compact('student', 'medical_share_records', 'acknowledgementReceipt', 'amountPaidInWords', 'category', 'dateOfTransaction', 'amountPaid', 'successMS', 'successMSUpdate'));
    }

    public function updateMedicalShare(Request $request, $id) {
        if(Auth::user()->role != '2') {
            return redirect()->back()->with('error', 'You do not have permission to access this page');
        }

        $validatedData = $request->validate([
            'medical_concern' => ['required', 'string', 'max:255'],
            'amount_due' => ['required', 'numeric'],
            'amount_paid' => ['nullable', 'numeric'],
            'date' => ['required', 'date'],
        ]);

        $send_amount_due_only = 0;
        if($request->has('send_amount_due_only_medical')) {
            $send_amount_due_only = 1;
        }

        $acknowledgementReceipt = 0;
        if($request->has('print_acknowledegement_receipt_medical')) {
            $acknowledgementReceipt = 1;
        }

        $dateOfTransaction = $validatedData['date'];
        $amountPaid = $validatedData['amount_paid'];
        $amountPaidUpdate = $validatedData['amount_paid'] + $request->input('amount_paid_previous');
        $amountPaidInWords = StoreLogsService::numberToWords($validatedData['amount_paid']);
        $category = "Medical Share";


        $amount = 0;
        if ($amountPaid == null) {
            $amount = $request->input('amount_paid_previous');
        }
        if ($amountPaid != null) {
            $amount = $amountPaid + $request->input('amount_paid_previous');
        }

        $medicalShare = MedicalShare::find(request()->input('medical_id'));
        $studentId = $medicalShare->student_id;
        $studentEmail = $medicalShare->student->email;
        $studentName = $medicalShare->student->first_name." ".$medicalShare->student->last_name;
        $studentBatchYear = $medicalShare->student->batch_year;
        $medicalShare->medical_concern = $validatedData['medical_concern'];
        $medicalShare->total_cost = $validatedData['amount_due'];
        $percent_share = $validatedData['amount_due'] * 0.15;
        $medicalShare->amount_paid = $amount;
        $medicalShare->date = $validatedData['date'];
        $medicalShare->student_id = $studentId;

        $medicalShare->save();
        $student = Student::find($id);
        if(!$student) {
            return back()->with('error', 'Student not found!');
        }

        // Log the action
        $action = "Updated";
        StoreLogsService::storeLogs(auth()->user()->id, $action, "Medical Share", $studentId, null, $studentBatchYear);

        // Send email notification to the student
        Mail::to($studentEmail)->send(new SendMedicalShareTransInfo($studentName, $medicalShare->medical_concern, $medicalShare->total_cost, $percent_share, $medicalShare->amount_paid, $medicalShare->date, $send_amount_due_only));
        // Return success message only if no duplicate was found
        $medical_share_records = MedicalShare::where('student_id', $studentId)->get();
        $successMS = 0;
        $successMSUpdate = 1;

        return view('pages.admin-auth.records.student-medical-share', compact('student', 'medical_share_records', 'acknowledgementReceipt', 'amountPaidInWords', 'category', 'dateOfTransaction', 'amountPaid', 'successMS', 'successMSUpdate'));
    }

    public function deleteMedicalShare($id) {
        if(Auth::user()->role != '2') {
            return redirect()->back()->with('error', 'You do not have permission to access this page');
        }

        $medicalShare = MedicalShare::find($id);

        if(!$medicalShare) {
            return back()->with('error', 'personal cash advance record not found.');
        }

        // Store student information before deletion
        $studentName = $medicalShare->student->first_name.' '.$medicalShare->student->last_name;
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
