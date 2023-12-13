<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Mail\SendGraduationFeeTransInfo;
use App\Models\GraduationFee;
use App\Models\Student;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Services\StoreLogsService;
use Illuminate\Support\Facades\Auth;

class GraduationFeeController extends Controller {
    public function graduationFees() {
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

        $studentIdsWithGraduationFees = GraduationFee::distinct()->pluck('student_id');
        $student_gf_records = Student::whereIn('id', $studentIdsWithGraduationFees)->get();
        $studentsWithoutGraduationFees = Student::whereNotIn('id', $studentIdsWithGraduationFees)->get();

        $gradutionFeesRecords = GraduationFee::select('student_id', \DB::raw('SUM(amount_due) as total_due'), \DB::raw('SUM(amount_paid) as total_paid'))
            ->groupBy('student_id')
            ->get();

        $totalAmounts = [];
        foreach($gradutionFeesRecords as $record) {
            $totalAmounts[$record->student_id] = [
                'amount_due' => $record->total_due,
                'amount_paid' => $record->total_paid,
            ];
        }

        return view('pages.admin-auth.records.graduation-fee', [
            'students' => $students,
            'batchYears' => $batchYears,
            'student_gf_records' => $student_gf_records,
            'totalAmounts' => $totalAmounts,
            'gradutionFeesRecords' => $gradutionFeesRecords,
            'studentsWithoutGraduationFees' => $studentsWithoutGraduationFees,
        ]);
    }

    public function studentGraduationFeeRecords($id) {
        if(Auth::user()->role != '2') {
            return redirect()->back()->with('error', 'You do not have permission to access this page');
        }

        $student = Student::find($id);

        if(!$student) {
            return back()->with('error', 'Student not found!');
        }

        $acknowledgementReceipt = null;
        $graduation_fee_records = GraduationFee::where('student_id', $student->id)->get();
        $successGF = 0;
        $successGFUpdate = 0;

        return view('pages.admin-auth.records.student-graduation-fee', compact('student', 'graduation_fee_records', 'acknowledgementReceipt', 'successGF', 'successGFUpdate'));
    }

    public function storeGraduationFee(Request $request, $id) {
        if(Auth::user()->role != '2') {
            return redirect()->back()->with('error', 'You do not have permission to access this page');
        }

        $validatedData = $request->validate([
            'amount_due' => ['required'],
            'amount_paid' => ['required'],
            'date' => ['required', 'date'],
        ]);

        $dateOfTransaction = $validatedData['date'];
        $amountPaid = $validatedData['amount_paid'];
        $amountPaidInWords = StoreLogsService::numberToWords($amountPaid);
        $category = "Graduation Fee";

        $send_amount_due_only = 0;
        if($request->has('send_amount_due_only')) {
            $send_amount_due_only = 1;
        }

        $acknowledgementReceipt = 0;
        if($request->has('print_acknowledegement_receipt')) {
            $acknowledgementReceipt = 1;
        }

        $student = Student::find($id);
        $student_email = $student->email;
        $student_name = $student->first_name.' '.$student->last_name;
        $student_batch_year = $student->batch_year;

        $graduation_fee = new GraduationFee();
        $graduation_fee->amount_due = $validatedData['amount_due'];
        $graduation_fee->amount_paid = $validatedData['amount_paid'];
        $graduation_fee->date = $validatedData['date'];
        $graduation_fee->student_id = $id;

        $graduation_fee->save();

        // Log the action
        $action = "Added";
        StoreLogsService::storeLogs(auth()->user()->id, $action, "Graduation Fee", $graduation_fee->student_id, null, $student_batch_year);

        Mail::to($student_email)->send(new SendGraduationFeeTransInfo($student_name, $graduation_fee->amount_due, $graduation_fee->amount_paid, $graduation_fee->date, $send_amount_due_only));

        $graduation_fee_records = GraduationFee::where('student_id', $student->id)->get();
        $successGF = 1;
        $successGFUpdate = 0;

        return view('pages.admin-auth.records.student-graduation-fee', compact('student', 'graduation_fee_records', 'amountPaid', 'amountPaidInWords', 'dateOfTransaction', 'category', 'acknowledgementReceipt', 'successGF', 'successGFUpdate'));
    }

    public function updateGraduationFee(Request $request, $id) {
        if(Auth::user()->role != '2') {
            return redirect()->back()->with('error', 'You do not have permission to access this page');
        }

        $validatedData = $request->validate([
            'amount_due' => ['required'],
            'amount_paid' => ['required'],
            'date' => ['required', 'date'],
        ]);

        $dateOfTransaction = $validatedData['date'];
        $amountPaid = $validatedData['amount_paid'];
        $amountPaidInWords = StoreLogsService::numberToWords($amountPaid);
        $category = "Graduation Fee";

        $send_amount_due_only = 0;
        if($request->has('send_amount_due_only')) {
            $send_amount_due_only = 1;
        }

        $acknowledgementReceipt = 0;
        if($request->has('print_acknowledegement_receipt')) {
            $acknowledgementReceipt = 1;
        }

        $graduationFee = GraduationFee::find($id);
        $studentId = $graduationFee->student_id;
        $studentEmail = $graduationFee->student->email;
        $studentName = $graduationFee->student->first_name." ".$graduationFee->student->last_name;

        $graduationFee->amount_due = $validatedData['amount_due'];
        $graduationFee->amount_paid = $validatedData['amount_paid'] + +$request->input('amount_paid_previous');
        $graduationFee->date = $validatedData['date'];
        $graduationFee->student_id = $studentId;

        $graduationFee->save();

        // Log the action
        $action = "Updated";
        StoreLogsService::storeLogs(auth()->user()->id, $action, "Graduation Fee", $studentId, null, $graduationFee->student->batch_year);

        // Send email notification to the student
        Mail::to($studentEmail)->send(new SendGraduationFeeTransInfo($studentName, $graduationFee->amount_due, $graduationFee->amount_paid, $graduationFee->date, $send_amount_due_only));

        $student = Student::find($studentId);

        if(!$student) {
            return back()->with('error', 'Student not found!');
        }

        $graduation_fee_records = GraduationFee::where('student_id', $student->id)->get();
        $successGF = 0;
        $successGFUpdate = 1;

        return view('pages.admin-auth.records.student-graduation-fee', compact('student', 'graduation_fee_records', 'amountPaid', 'amountPaidInWords', 'dateOfTransaction', 'category', 'acknowledgementReceipt', 'successGF', 'successGFUPdate'));
    }

    public function deleteGraduationFee(Request $request, $id) {
        if(Auth::user()->role != '2') {
            return redirect()->back()->with('error', 'You do not have permission to access this page');
        }

        $graduationFee = GraduationFee::find($id);

        if(!$graduationFee) {
            return back()->with('error', 'Personal cash advance record not found.');
        }

        // Store student information before deletion
        $studentName = $graduationFee->student->first_name.' '.$graduationFee->student->last_name;
        $studentEmail = $graduationFee->student->email;
        $studentId = $graduationFee->student->id;
        $month = $graduationFee->month;
        $year = $graduationFee->year;
        $amountDue = $graduationFee->amount_due;
        $amountPaid = $graduationFee->amount_paid;
        $date = $graduationFee->date;

        // Log the action
        $action = "Deleted";
        StoreLogsService::storeLogs(auth()->user()->id, $action, "Personal Cash Advance", $studentId, null, $graduationFee->student->batch_year);

        Mail::to($studentEmail)->send(new SendDeletionNotification($studentName, $amountDue, $amountPaid, $date));

        $graduationFee->delete();

        // Return success message
        return back()->with('success', 'Personal cash advance record deleted and emeil sent successfully.');
    }
}
