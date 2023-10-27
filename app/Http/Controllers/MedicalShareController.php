<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\MedicalShare;
use App\Models\Student;
use Illuminate\Http\Request;

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
    
        $studentIdsWithMedicalShares = MedicalShare::distinct()->pluck('student_id');
        $student_ms_records = Student::whereIn('id', $studentIdsWithMedicalShares)->get();
    
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
            'amount_due' => ['required', 'numeric'],
            'amount_paid' => ['required', 'numeric'],
            'date' => ['required', 'date'],
        ]);

        $medical_share = new MedicalShare();
        $medical_share->medical_concern = $validatedData['medical_concern'];
        $medical_share->total_cost = $validatedData['amount_due'];
        $medical_share->amount_paid = $validatedData['amount_paid'];
        $medical_share->date = $validatedData['date'];
        $medical_share->student_id = $id;
        $medical_share->save();

        return back()->with('success', 'medical_share record added!', compact('medical_share'));
    }
}
