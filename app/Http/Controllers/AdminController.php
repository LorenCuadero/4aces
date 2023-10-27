<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Mail\SendClosingOfAccountsEmail;
use App\Mail\SendEmailPayable;
use App\Models\Admin;
use App\Models\Counterpart;
use App\Models\GraduationFee;
use App\Models\MedicalShare;
use App\Models\PersonalCashAdvance;
use App\Models\Student;
use DateTime;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class AdminController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function indexAdmin()
    {
        // Calculate the total amount due from each table
        $medicalShareTotal = MedicalShare::sum('total_cost') * 0.15;
        $counterpartTotal = Counterpart::sum('amount_due');
        $graduationFeeTotal = GraduationFee::sum('amount_due');
        $personalCashAdvanceTotal = PersonalCashAdvance::sum('amount_due');

        // Receivables
        $medicalShareReceivable = MedicalShare::sum('total_cost') - MedicalShare::sum('amount_paid');
        $counterpartReceivable = Counterpart::sum('amount_due') - Counterpart::sum('amount_paid');
        $graduationFeeReceivable = GraduationFee::sum('amount_due') - GraduationFee::sum('amount_paid');
        $personalCashAdvanceReceivable = PersonalCashAdvance::sum('amount_due') - PersonalCashAdvance::sum('amount_paid');
        $receivableTotal = $medicalShareReceivable + $counterpartReceivable + $graduationFeeReceivable + $personalCashAdvanceReceivable;
    
        // Received
        $medicalShareReceived = MedicalShare::sum('amount_paid');
        $counterpartReceived = Counterpart::sum('amount_paid');
        $graduationFeeReceived = GraduationFee::sum('amount_paid');
        $personalCashAdvanceReceived = PersonalCashAdvance::sum('amount_paid');
        $receivedTotal = $medicalShareReceived + $counterpartReceived + $graduationFeeReceived + $personalCashAdvanceReceived;

        // Count the total number of students
        $totalNumberOfStudents = Student::count();

        // Count the number of students who have paid for each category
        $medicalSharePaidCount = MedicalShare::where('amount_paid', '>', 0)->count();
        $counterpartPaidCount = Counterpart::where('amount_paid', '>', 0)->count();
        $graduationFeePaidCount = GraduationFee::where('amount_paid', '>', 0)->count();
        $personalCashAdvancePaidCount = PersonalCashAdvance::where('amount_paid', '>', 0)->count();

        // Calculate the percentage for each category
        $medicalSharePercentage = ($medicalSharePaidCount / $totalNumberOfStudents) * 100;
        $counterpartPercentage = ($counterpartPaidCount / $totalNumberOfStudents) * 100;
        $graduationFeePercentage = ($graduationFeePaidCount / $totalNumberOfStudents) * 100;
        $personalCashAdvancePercentage = ($personalCashAdvancePaidCount / $totalNumberOfStudents) * 100;

        // Pass the totals and percentages to the view
        return view('pages.admin-auth.dashboard.index', [
            'medicalShareTotal' => $medicalShareTotal,
            'counterpartTotal' => $counterpartTotal,
            'graduationFeeTotal' => $graduationFeeTotal,
            'personalCashAdvanceTotal' => $personalCashAdvanceTotal,
            'medicalSharePercentage' => $medicalSharePercentage,
            'counterpartPercentage' => $counterpartPercentage,
            'graduationFeePercentage' => $graduationFeePercentage,
            'personalCashAdvancePercentage' => $personalCashAdvancePercentage,
            'receivableTotal' => $receivableTotal,
            'receivedTotal' => $receivedTotal,
        ]);
    }

    public function email()
    {
        $students = Student::all();

        $batchYears = [];

        foreach ($students as $student) {
            if (!in_array($student->batch_year, $batchYears)) {
                $batchYears[] = $student->batch_year;
            }
        }

        return view('pages.admin-auth.email.index', [
            'students' => $students,
            'batchYears' => $batchYears,
        ]);
    }

    public function sendEmail(Request $request)
    {
        $students = Student::where('batch_year', $request->selectedBatchYear)->get();
        $month = $request->month;
        $year = $request->year;

        foreach ($students as $student) {
            $student_name = $student->first_name . ' ' . $student->last_name;
            Mail::to($student->email)->send(new SendEmailPayable($student_name, $month, $year));
        }

        return redirect()->back()->with('success', 'Emails sent successfully');
    }

    public function coa()
    {
        $students = Student::all();

        $batchYears = [];

        foreach ($students as $student) {
            if (!in_array($student->batch_year, $batchYears)) {
                $batchYears[] = $student->batch_year;
            }
        }

        return view('pages.admin-auth.coa.index', [
            'students' => $students,
            'batchYears' => $batchYears,
        ]);
    }

    public function sendCOA(Request $request)
    {
        $students = Student::where('batch_year', $request->selectedBatchYear)->get();
        $graduation_date_value = $request->graduation_date;
        $datetime = new DateTime($graduation_date_value);
        $graduation_date = $datetime->format('F d, Y');

        foreach ($students as $student) {
            $student_name = $student->first_name . ' ' . $student->last_name;
            Mail::to($student->email)->send(new SendClosingOfAccountsEmail($student_name, $graduation_date));
        }

        return redirect()->back()->with('success', 'Emails sent successfully');
    }

    public function index()
    {
        $students = Student::all();

        $batchYears = [];

        foreach ($students as $student) {
            if (!in_array($student->batch_year, $batchYears)) {
                $batchYears[] = $student->batch_year;
            }
        }

        return view('pages.staff-auth.students.index', [
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
    public function show(Admin $admin)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Admin $admin)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Admin $admin)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Admin $admin)
    {
        //
    }
}
