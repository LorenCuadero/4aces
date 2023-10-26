<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Counterpart;
use App\Models\Student;
use Illuminate\Http\Request;

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
            'amount_due' => 'required|integer',
            'amount_paid' => 'required|integer',
            'date' => 'required',
        ]);

        $counterpart = new Counterpart();
        $counterpart->month = $validatedData['month'];
        $counterpart->amount_due = $validatedData['amount_due'];
        $counterpart->amount_paid = $validatedData['amount_paid'];
        $counterpart->date = $validatedData['date'];
        $counterpart->student_id = $id;

        $counterpart->save();

        return back()->with('success', 'Counterpart record added!', compact('counterpart'));
    }
}
