<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Mail\SendDeletionNotificationPCA;
use App\Mail\SendPersonalCATransInfo;
use App\Models\PersonalCashAdvance;
use App\Models\Student;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Services\StoreLogsService;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class PersonalCashAdvanceController extends Controller {
    public function personalCA() {
        if(Auth::user()->role != '2') {
            return redirect()->back()->with('error', 'You do not have permission to access this page');
        }

        $users = User::where('is_deleted', false)->get();
        $studentIds = $users->pluck('id');
        $students = Student::whereIn('user_id', $studentIds)->get();

        $batchYears = [];

        foreach($students as $student) {
            if(!in_array($student->batch_year, $batchYears)) {
                $batchYears[] = $student->batch_year;
            }
        }

        $studentIdsWithPersonalCA = PersonalCashAdvance::distinct()->pluck('student_id');
        $student_pca_records = Student::whereIn('id', $studentIdsWithPersonalCA)->get();
        $studentsWithoutPCA = Student::whereNotIn('id', $studentIdsWithPersonalCA)->whereIn('user_id', function ($query) {
            $query->select('id')
                ->from('users')
                ->where('is_deleted', false);
        })->get();

        $personalCArecords = PersonalCashAdvance::select('student_id', \DB::raw('SUM(amount_due) as total_due'), \DB::raw('SUM(amount_paid) as total_paid'))
            ->groupBy('student_id')
            ->get();

        $totalAmounts = [];
        foreach($personalCArecords as $record) {
            $totalAmounts[$record->student_id] = [
                'amount_due' => $record->total_due,
                'amount_paid' => $record->total_paid,
            ];
        }

        return view('pages.admin-auth.records.personal-ca', [
            'students' => $students,
            'batchYears' => $batchYears,
            'student_pca_records' => $student_pca_records,
            'totalAmounts' => $totalAmounts,
            'personalCArecords' => $personalCArecords,
            'studentsWithoutPCA' => $studentsWithoutPCA,
        ]);
    }

    public function studentPersonalCARecords($id) {
        if(Auth::user()->role != '2') {
            return redirect()->back()->with('error', 'You do not have permission to access this page');
        }

        $student = Student::find($id);

        if(!$student) {
            return back()->with('error', 'Student not found!');
        }
        $acknowledgementReceipt = null;
        $personal_ca_records = PersonalCashAdvance::where('student_id', $student->id)->get();
        $successPCA = 0;
        $successPCAUpdate = 0;

        return view('pages.admin-auth.records.student-personal-ca', compact('student', 'personal_ca_records', 'acknowledgementReceipt', 'successPCA', 'successPCAUpdate'));
    }

    public function storePersonalCA(Request $request, $id) {
        if(Auth::user()->role != '2') {
            return redirect()->back()->with('error', 'You do not have permission to access this page');
        }

        $validatedData = $request->validate([
            'purpose' => ['required', 'string', 'max:255'],
            'amount_due' => ['required'],
            'amount_paid' => ['nullable'],
            'date' => ['required', 'date'],
        ]);

        $dateOfTransaction = $validatedData['date'];
        $amountPaid = $validatedData['amount_paid'];
        $amountPaidInWords = StoreLogsService::numberToWords($amountPaid);
        $category = "Personal Cash Advance";

        $send_amount_due_only = 0;
        if($request->has('send_amount_due_only')) {
            $send_amount_due_only = 1;
        }

        $acknowledgementReceipt = 0;
        if($request->has('print_acknowledegement_receipt')) {
            $acknowledgementReceipt = 1;
        }

        $amount = 0;
        if ($amountPaid == null) {
            $amount = 0;
        }
        if ($amountPaid != null) {
            $amount = $amountPaid;
        }

        $personal_ca = new PersonalCashAdvance();
        $personal_ca->purpose = $validatedData['purpose'];
        $personal_ca->amount_due = $validatedData['amount_due'];
        $personal_ca->amount_paid = $amount;
        $personal_ca->date = $validatedData['date'];
        $personal_ca->student_id = $id;

        $student = Student::find($id);
        $student_email = $student->email;
        $student_name = $student->first_name.' '.$student->last_name;

        $personal_ca->save();

        // Log the action
        $action = "Added";
        StoreLogsService::storeLogs(auth()->user()->id, $action, "Personal Cash Advance", $personal_ca->student_id, null, $student->batch_year);

        $student = Student::find($id);

        if(!$student) {
            return back()->with('error', 'Student not found!');
        }

        Mail::to($student_email)->send(new SendPersonalCATransInfo($student_name, $personal_ca->purpose, $personal_ca->amount_due, $personal_ca->amount_paid, $personal_ca->date, $send_amount_due_only));

        $personal_ca_records = PersonalCashAdvance::where('student_id', $student->id)->get();
        $successPCA = 1;
        $successPCAUpdate = 0;

        return view('pages.admin-auth.records.student-personal-ca', compact('student', 'personal_ca_records', 'amountPaid', 'amountPaidInWords', 'dateOfTransaction', 'category', 'acknowledgementReceipt', 'successPCA', 'successPCAUpdate'));
    }

    public function updatePersonalCA(Request $request, $id) {
        if(Auth::user()->role != '2') {
            return redirect()->back()->with('error', 'You do not have permission to access this page');
        }

        $validatedData = $request->validate([
            'purpose' => ['required', 'string', 'max:255'],
            'amount_due' => ['required'],
            'amount_paid' => ['nullable'],
            'date' => ['required', 'date'],
        ]);

        $dateOfTransaction = $validatedData['date'];
        $amountPaid = $validatedData['amount_paid'];
        $amountPaidInWords = StoreLogsService::numberToWords($amountPaid);
        $category = "Personal Cash Advance";

        $send_amount_due_only = 0;
        if($request->has('send_amount_due_only')) {
            $send_amount_due_only = 1;
        }

        $acknowledgementReceipt = 0;
        if($request->has('print_acknowledegement_receipt')) {
            $acknowledgementReceipt = 1;
        }

        $personal_cash_advance = PersonalCashAdvance::find($id);
        $studentId = $personal_cash_advance->student_id;
        $studentEmail = $personal_cash_advance->student->email;
        $studentName = $personal_cash_advance->student->first_name." ".$personal_cash_advance->student->last_name;

        $amount = 0;
        if ($amountPaid == null) {
            $amount = $request->input('amount_paid_previous');
        }
        if ($amountPaid != null) {
            $amount = $amountPaid + $request->input('amount_paid_previous');
        }

        $personal_cash_advance->purpose = $validatedData['purpose'];
        $personal_cash_advance->amount_due = $validatedData['amount_due'];
        $personal_cash_advance->amount_paid = $amount;
        $personal_cash_advance->date = $validatedData['date'];
        $personal_cash_advance->student_id = $studentId;

        $personal_cash_advance->save();

        // Log the action
        $action = "Updated";
        StoreLogsService::storeLogs(auth()->user()->id, $action, "Personal Cash Advance", $studentId, null, $personal_cash_advance->student->batch_year);

        // Send email notification to the student
        Mail::to($studentEmail)->send(new SendPersonalCATransInfo($studentName, $personal_cash_advance->purpose, $personal_cash_advance->amount_due, $personal_cash_advance->amount_paid, $personal_cash_advance->date, $send_amount_due_only));

        $student = Student::find($studentId);

        if(!$student) {
            return back()->with('error', 'Student not found!');
        }

        $personal_ca_records = PersonalCashAdvance::where('student_id', $studentId)->get();
        $successPCA = 0;
        $successPCAUpdate = 1;

        return view('pages.admin-auth.records.student-personal-ca', compact('student', 'personal_ca_records', 'amountPaid', 'amountPaidInWords', 'dateOfTransaction', 'category', 'acknowledgementReceipt', 'successPCA', 'successPCAUpdate'));
    }

    public function deletePersonalCA($id) {
        if(Auth::user()->role != '2') {
            return redirect()->back()->with('error', 'You do not have permission to access this page');
        }

        $personalCA = PersonalCashAdvance::find($id);

        if(!$personalCA) {
            return back()->with('error', 'Personal cash advance record not found.');
        }

        // Store student information before deletion
        $studentName = $personalCA->student->first_name.' '.$personalCA->student->last_name;
        $studentEmail = $personalCA->student->email;
        $studentId = $personalCA->student->id;
        $month = $personalCA->month;
        $year = $personalCA->year;
        $amountDue = $personalCA->amount_due;
        $amountPaid = $personalCA->amount_paid;
        $date = $personalCA->date;

        // Log the action
        $action = "Deleted";
        StoreLogsService::storeLogs(auth()->user()->id, $action, "Personal Cash Advance", $studentId, null, $personalCA->student->batch_year);

        Mail::to($studentEmail)->send(new SendDeletionNotificationPCA($studentName, $amountDue, $amountPaid, $date));

        $personalCA->delete();

        // Return success message
        return back()->with('success', 'Personal cash advance record deleted and emeil sent successfully.');
    }
}

