<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\MedicalShare;
use App\Models\Student;
use Illuminate\Http\Request;

class MedicalShareController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function medicalShare()
    {
        $students = Student::all();

        $batchYears = [];

        foreach ($students as $student) {
            if (!in_array($student->batch_year, $batchYears)) {
                $batchYears[] = $student->batch_year;
            }
        }

        return view('pages.admin-auth.records.medical-share', [
            'students' => $students,
            'batchYears' => $batchYears,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(MedicalShare $medicalShare)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(MedicalShare $medicalShare)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, MedicalShare $medicalShare)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(MedicalShare $medicalShare)
    {
        //
    }
}
