<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Mail\SendDeletionNotification;
use App\Mail\SendReceiptOrPaymentInfo;
use App\Models\Counterpart;
use App\Models\Student;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Cache;
use App\Services\StoreLogsService;

class CounterpartController extends Controller {

    public function counterpartRecords() {
        $students = Student::all();

        // Fetch all students who have counterpart records
        $studentIdsWithCounterparts = Counterpart::distinct()->pluck('student_id');
        $students_counterpart_records = Student::whereIn('id', $studentIdsWithCounterparts)->get();
        $studentsWithoutCounterparts = Student::whereNotIn('id', $studentIdsWithCounterparts)->get();

        // Fetch and organize the counterpart records data
        $counterpartRecords = Counterpart::select('student_id', \DB::raw('SUM(amount_due) as total_due'), \DB::raw('SUM(amount_paid) as total_paid'))
            ->groupBy('student_id')
            ->get();

        $totalAmounts = [];
        foreach($counterpartRecords as $record) {
            $totalAmounts[$record->student_id] = [
                'amount_due' => $record->total_due,
                'amount_paid' => $record->total_paid,
            ];
        }
        $data['header_title'] = "Counterpart Record |";
        return view('pages.admin-auth.records.counterpart', [
            'students' => $students,
            'students_counterpart_records' => $students_counterpart_records,
            'studentsWithoutCounterparts' => $studentsWithoutCounterparts,
            'totalAmounts' => $totalAmounts,
            'counterpartRecords' => $counterpartRecords,
        ], $data);
    }

    // foreach ($students as $student) {
    //     $totalAmountDue = Counterpart::where('student_id', $student->id)->sum('amount_due');
    //     $totalAmountPaid = Counterpart::where('student_id', $student->id)->sum('amount_paid');

    //     $totalAmounts[$student->id] = [
    //         'student' => $student,
    //         'amount_due' => $totalAmountDue,
    //         'amount_paid' => $totalAmountPaid,
    //     ];
    // }

    // $counterpartRecords = Counterpart::all();

    // $batchYears = Student::distinct()->pluck('batch_year');

    // return view('pages.admin-auth.records.counterpart', [
    //     'students' => $students,
    //     'batchYears' => $batchYears,
    //     'totalAmounts' => $totalAmounts,
    //     'counterpartRecords' => $counterpartRecords,
    // ]);

    public function studentPageCounterpartRecords($id) {
        $student = Student::find($id);

        if(!$student) {
            return back()->with('error', 'Student not found!');
        }

        $student_counterpart_records = Counterpart::where('student_id', $student->id)->get();

        $months = [
            1 => 'January',
            2 => 'February',
            3 => 'March',
            4 => 'April',
            5 => 'May',
            6 => 'June',
            7 => 'July',
            8 => 'August',
            9 => 'September',
            10 => 'October',
            11 => 'November',
            12 => 'December',
        ];

        $monthNames = $student_counterpart_records->pluck('month')->map(function ($month) use ($months) {
            return $months[$month];
        });

        $data['header_title'] = "Counterpart Record |";

        $acknowledgementReceipt = null;
        return view('pages.admin-auth.records.student-counterpart', compact('student', 'student_counterpart_records', 'monthNames', 'months', 'acknowledgementReceipt'), $data);
    }

    public function storeCounterpart(Request $request, $id) {
        $validatedData = $request->validate([
            'month' => 'required|string',
            'year' => 'required|integer',
            'amount_due' => 'required',
            'amount_paid' => 'required',
            'date' => 'required',
        ]);

        $dateOfTransaction = $validatedData['date'];
        $amountPaid = $validatedData['amount_paid'];
        $amountPaidInWords = $this->numberToWords($amountPaid);
        $category = "Parents Counterpart";

        $send_amount_due_only = 0;
        if($request->has('send_amount_due_only')) {
            $send_amount_due_only = 1;
        }

        // Find the student by ID
        $student = Student::find($id);

        // Check for duplicates
        if($student->counterpart()->where('month', $request->input('month'))
            ->where('year', $request->input('year'))
            ->exists()
        ) {
            return back()->with('error', 'Counterpart record failed to add, combination of month and year already exists!');
        }

        $counterpart = $student->counterpart()->create($validatedData);

        $acknowledgementReceipt = 0;
        if($request->has('print_acknowledegement_receipt')) {
            $acknowledgementReceipt = 1;
        }

        // Log the action
        $action = "Added";
        StoreLogsService::storeLogs(auth()->user()->id, $action, "Counterpart", $counterpart->student_id, null, $student->batch_year);
        // Send email notification to the student

        Mail::to($student->email)->send(
            new SendReceiptOrPaymentInfo(
                $student->full_name,
                $counterpart->month,
                $counterpart->year,
                $counterpart->amount_due,
                $counterpart->amount_paid,
                $counterpart->date,
                $send_amount_due_only
            )
        );

        if(!$student) {
            return back()->with('error', 'Student not found!');
        }

        $student_counterpart_records = Counterpart::where('student_id', $student->id)->get();

        $months = [
            1 => 'January',
            2 => 'February',
            3 => 'March',
            4 => 'April',
            5 => 'May',
            6 => 'June',
            7 => 'July',
            8 => 'August',
            9 => 'September',
            10 => 'October',
            11 => 'November',
            12 => 'December',
        ];

        $monthNames = $student_counterpart_records->pluck('month')->map(function ($month) use ($months) {
            return $months[$month];
        });

        return view('pages.admin-auth.records.student-counterpart', compact(
            'student',
            'student_counterpart_records',
            'monthNames',
            'months',
            'acknowledgementReceipt',
            'counterpart',
            'dateOfTransaction',
            'amountPaid',
            'amountPaidInWords',
            'category'
        ))->with('success', 'Counterpart record added and email sent successfully!');

    }

    function numberToWords($number) {
        $words = [
            'zero', 'one', 'two', 'three', 'four', 'five', 'six', 'seven', 'eight', 'nine',
            'ten', 'eleven', 'twelve', 'thirteen', 'fourteen', 'fifteen', 'sixteen', 'seventeen', 'eighteen', 'nineteen'
        ];

        $tens = [
            '', '', 'twenty', 'thirty', 'forty', 'fifty', 'sixty', 'seventy', 'eighty', 'ninety'
        ];

        $num = abs((int)$number);
        $result = '';

        if($num < 20) {
            $result = $words[$num];
        } elseif($num < 100) {
            $result = $tens[(int)($num / 10)];
            if($num % 10) {
                $result .= '-'.$words[$num % 10];
            }
        } elseif($num < 1000) {
            $result = $words[(int)($num / 100)].' hundred';
            if($num % 100) {
                $result .= ' and '.$this->numberToWords($num % 100);
            }
        } elseif($num < 12000) {
            $result = $words[(int)($num / 1000)].' thousand';
            if($num % 1000) {
                $result .= ' '.$this->numberToWords($num % 1000);
            }
        } else {
            // For simplicity, you can extend this function for larger numbers if needed
            $result = 'Number is too large for conversion';
        }

        return $result;
    }

    public function updateCounterpart(Request $request, $id) {
        $counterpart = Counterpart::find($id);

        if($request->input('amount_due') == null) {
            return back()->with('error', 'Amount due cannot be empty!');
        }

        $counterpart = Counterpart::find($id);
        $studentId = $counterpart->student_id;
        $studentEmail = $counterpart->student->email;
        $studentName = $counterpart->student->first_name." ".$counterpart->student->last_name;
        $studentBatchYear = $counterpart->student->batch_year;

        // Check for duplicates
        $existingCounterpart = Counterpart::where('month', $request->input('month'))
            ->where('year', $request->input('year'))
            ->where('student_id', $studentId)
            ->first();

        $amount_paid = 0;
        if($request->input('amount_paid') != null) {
            $amount_paid = $request->input('amount_paid');
        }

        $counterpart->month = $request->input('month');
        $counterpart->year = $request->input('year');
        $counterpart->amount_due = $request->input('amount_due');
        $counterpart->amount_paid = $request->input('amount_paid_previously') + $amount_paid;
        $counterpart->date = $request->input('date');
        $counterpart->student_id = $studentId;
        $counterpart->save();
        $dateOfTransaction = $request->input('date');
        $amountPaid = $amount_paid;
        $amountPaidInWords = $this->numberToWords($amountPaid);
        $category = "Parents Counterpart";

        $send_amount_due_only = 0;
        if($request->input('send_amount_due_only_edit_counterpart') == 1) {
            $send_amount_due_only = 1;
        }

        $student = Student::find($studentId);

        $acknowledgementReceipt = 0;
        if($request->has('print_acknowledegement_receipt_edit_counterpart')) {
            $acknowledgementReceipt = 1;
        }

        $numericMonth = $request->input('month');
        $monthName = date('F', mktime(0, 0, 0, $numericMonth, 1));

        // Log the action
        $action = "Updated";
        StoreLogsService::storeLogs(auth()->user()->id, $action, "Counterpart", $studentId, null, $studentBatchYear);

        // Send email notification to the student
        Mail::to($studentEmail)->send(new SendReceiptOrPaymentInfo($studentName, $counterpart->month, $counterpart->year, $counterpart->amount_due, $counterpart->amount_paid, $counterpart->date, $send_amount_due_only));
        if(!$student) {
            return back()->with('error', 'Student not found!');
        }

        $student_counterpart_records = Counterpart::where('student_id', $student->id)->get();

        $months = [
            1 => 'January',
            2 => 'February',
            3 => 'March',
            4 => 'April',
            5 => 'May',
            6 => 'June',
            7 => 'July',
            8 => 'August',
            9 => 'September',
            10 => 'October',
            11 => 'November',
            12 => 'December',
        ];

        $monthNames = $student_counterpart_records->pluck('month')->map(function ($month) use ($months) {
            return $months[$month];
        });

        return view('pages.admin-auth.records.student-counterpart', compact(
            'student',
            'student_counterpart_records',
            'monthNames',
            'months',
            'acknowledgementReceipt',
            'counterpart',
            'dateOfTransaction',
            'amountPaid',
            'amountPaidInWords',
            'category'
        ))->with('success', 'Counterpart record updated and email sent successfully!');
    }

    public function deleteCounterpart($id) {
        // Find the Counterpart record by ID
        $counterpart = Counterpart::find($id);

        if(!$counterpart) {
            return back()->with('error', 'Counterpart record not found.');
        }

        // Store student information before deletion
        $studentName = $counterpart->student->first_name.' '.$counterpart->student->last_name;
        $studentEmail = $counterpart->student->email;
        $studentId = $counterpart->student->id;
        $month = $counterpart->month;
        $year = $counterpart->year;
        $amountDue = $counterpart->amount_due;
        $amountPaid = $counterpart->amount_paid;
        $date = $counterpart->date;
        $studentBatchYear = $counterpart->student->batch_year;

        // Log the action
        $action = "Deleted";
        StoreLogsService::storeLogs(auth()->user()->id, $action, "Counterpart", $studentId, null, $studentBatchYear);

        Mail::to($studentEmail)->send(new SendDeletionNotification($studentName, $month, $year, $amountDue, $amountPaid, $date));

        $counterpart->delete();

        // Return success message
        return back()->with('success', 'Counterpart record deleted and email sent successfully!');
    }
}
