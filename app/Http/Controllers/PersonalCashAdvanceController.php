<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Mail\SendPersonalCATransInfo;
use App\Mail\SendReceiptOrPaymentInfo;
use App\Models\PersonalCashAdvance;
use App\Models\Student;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class PersonalCashAdvanceController extends Controller
{
    public function personalCA()
    {
        $students = Student::all();

        $batchYears = [];

        foreach ($students as $student) {
            if (!in_array($student->batch_year, $batchYears)) {
                $batchYears[] = $student->batch_year;
            }
        }

        $studentIdsWithPersonalCA = PersonalCashAdvance::distinct()->pluck('student_id');
        $student_pca_records = Student::whereIn('id', $studentIdsWithPersonalCA)->get();
        $studentsWithoutPCA = Student::whereNotIn('id', $studentIdsWithPersonalCA)->get();

        $personalCArecords = PersonalCashAdvance::select('student_id', \DB::raw('SUM(amount_due) as total_due'), \DB::raw('SUM(amount_paid) as total_paid'))
            ->groupBy('student_id')
            ->get();

        $totalAmounts = [];
        foreach ($personalCArecords as $record) {
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

    public function studentPersonalCARecords($id)
    {
        $student = Student::find($id);

        if (!$student) {
            return back()->with('error', 'Student not found!');
        }

        $personal_ca_records = PersonalCashAdvance::where('student_id', $student->id)->get();

        return view('pages.admin-auth.records.student-personal-ca', compact('student', 'personal_ca_records'));
    }

    public function storePersonalCA(Request $request, $id)
    {
        $validatedData = $request->validate([
            'purpose' => ['required', 'string', 'max:255'],
            'amount_due' => ['required', 'numeric'],
            'amount_paid' => ['required', 'numeric'],
            'date' => ['required', 'date'],
        ]);

        $personal_ca = new PersonalCashAdvance();
        $personal_ca->purpose = $validatedData['purpose'];
        $personal_ca->amount_due = $validatedData['amount_due'];
        $personal_ca->amount_paid = $validatedData['amount_paid'];
        $personal_ca->date = $validatedData['date'];
        $personal_ca->student_id = $id;

        $student = Student::find($id);
        $student_email = $student->email;
        $student_name = $student->first_name . ' ' . $student->last_name;

        $personal_ca->save();

        Mail::to($student_email)->send(new SendPersonalCATransInfo($student_name, $personal_ca->purpose, $personal_ca->amount_due, $personal_ca->amount_paid, $personal_ca->date));

        return back()->with('success', 'personal_ca record added!', compact('personal_ca'));
    }

    public function updatePersonalCA(Request $request, $id)
    {
        $validatedData = $request->validate([
            'purpose' => ['required', 'string', 'max:255'],
            'amount_due' => ['required', 'numeric'],
            'amount_paid' => ['required', 'numeric'],
            'date' => ['required', 'date'],
        ]);

        $personal_cash_advance = PersonalCashAdvance::find($id);
        $studentId = $personal_cash_advance->student_id;
        $studentEmail = $personal_cash_advance->student->email;
        $studentName = $personal_cash_advance->student->first_name . " " . $personal_cash_advance->student->last_name;

        $personal_cash_advance->purpose = $validatedData['purpose'];
        $personal_cash_advance->amount_due = $validatedData['amount_due'];
        $personal_cash_advance->amount_paid = $validatedData['amount_paid'];
        $personal_cash_advance->date = $validatedData['date'];
        $personal_cash_advance->student_id = $studentId;

        $personal_cash_advance->save();

        // Send email notification to the student
        Mail::to($studentEmail)->send(new SendPersonalCATransInfo($studentName, $personal_cash_advance->purpose, $personal_cash_advance->amount_due, $personal_cash_advance->amount_paid, $personal_cash_advance->date));

        // Return success message only if no duplicate was found
        return back()->with('success', 'personal_cash_advance record updated!', compact('personal_cash_advance'));
    }
}

