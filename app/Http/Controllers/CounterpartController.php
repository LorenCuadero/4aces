<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Mail\SendReceiptOrPaymentInfo;
use App\Models\Counterpart;
use App\Models\Student;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class CounterpartController extends Controller
{

    public function counterpartRecords()
    {

        $students = Student::all();

        // Fetch all students who have counterpart records
        $studentIdsWithCounterparts = Counterpart::distinct()->pluck('student_id');
        $students_counterpart_records = Student::whereIn('id', $studentIdsWithCounterparts)->get();

        // Fetch and organize the counterpart records data
        $counterpartRecords = Counterpart::select('student_id', \DB::raw('SUM(amount_due) as total_due'), \DB::raw('SUM(amount_paid) as total_paid'))
            ->groupBy('student_id')
            ->get();

        $totalAmounts = [];
        foreach ($counterpartRecords as $record) {
            $totalAmounts[$record->student_id] = [
                'amount_due' => $record->total_due,
                'amount_paid' => $record->total_paid,
            ];
        }

        return view('pages.admin-auth.records.counterpart', [
            'students' => $students,
            'students_counterpart_records' => $students_counterpart_records,
            'totalAmounts' => $totalAmounts,
            'counterpartRecords' => $counterpartRecords,
        ]);
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

    public function studentPageCounterpartRecords($id)
    {
        $student = Student::find($id);

        if (!$student) {
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

        return view('pages.admin-auth.records.student-counterpart', compact('student', 'student_counterpart_records', 'monthNames', 'months'));
    }

    public function storeCounterpart(Request $request, $id)
    {
        $validatedData = $request->validate([
            'month' => 'required|string',
            'year' => 'required|integer',
            'amount_due' => 'required|integer',
            'amount_paid' => 'required|integer',
            'date' => 'required',
        ]);
    
        $student = Student::find($id);
        $student_email = $student->email;
        $student_name = $student->first_name . ' ' . $student->last_name;
    
        // Check for duplicates
        $existingCounterpart = Counterpart::where('month', $validatedData['month'])
            ->where('year', $validatedData['year'])
            ->where('student_id', $id)
            ->first();
    
        if ($existingCounterpart) {
            // A record with the same month, year, and student_id already exists.
            // You can handle this as needed, e.g., show an error message.
            return back()->with('error', 'Duplicate counterpart record found');
        }
    
        // If no duplicate is found, create and save the counterpart record.
        $counterpart = new Counterpart();
        $counterpart->month = $validatedData['month'];
        $counterpart->year = $validatedData['year'];
        $counterpart->amount_due = $validatedData['amount_due'];
        $counterpart->amount_paid = $validatedData['amount_paid'];
        $counterpart->date = $validatedData['date'];
        $counterpart->student_id = $id;
    
        $counterpart->save();
    
        // Send email notification to the student
        Mail::to($student->email)->send(new SendReceiptOrPaymentInfo($student_name, $counterpart->month, $counterpart->year, $counterpart->amount_due, $counterpart->amount_paid, $counterpart->date));
    
        return back()->with('success', 'Counterpart record added!', compact('counterpart'));
    }    
}