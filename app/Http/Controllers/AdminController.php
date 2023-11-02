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

        // Batch Years
        $batchYears = Student::distinct('batch_year')->pluck('batch_year');

        $totalStudentsByBatchYear = [];
        foreach ($batchYears as $year) {
            $totalStudentsByBatchYear[$year] = Student::where('batch_year', $year)->count();
        }

        // Calculate the total number of students that are paid in:
        // Counterparts
        $counterpartPaidStudentsCount = Counterpart::whereColumn('amount_paid', '=', 'amount_due')->count();
        // MedicalShare
        $medicalSharePaidStudentsCount = MedicalShare::whereColumn('amount_paid', '=', \DB::raw('total_cost * 0.15'))->count();
        // Personal Cash Advance
        $personalCashAdvancePaidStudentsCount = PersonalCashAdvance::whereColumn('amount_paid', '=', 'amount_due')->count();
        // Graduation Fee
        $graduationFeePaidStudentsCount = GraduationFee::whereColumn('amount_paid', '=', 'amount_due')->count();

        // Calculate the total number of students that are not fully paid in:
        // Counterparts
        $counterpartNotFullyPaidStudentsCount = Counterpart::whereColumn('amount_paid', '<', 'amount_due')->count();
        // MedicalShare
        $medicalShareNotFullyPaidStudentsCount = MedicalShare::whereColumn('amount_paid', '<', \DB::raw('total_cost * 0.15'))->count();
        // Personal Cash Advance
        $personalCashAdvanceNotFullyPaidStudentsCount = PersonalCashAdvance::where('amount_paid', '<', 'amount_due')->count();
        // Graduation Fee
        $graduationFeeNotFullyPaidStudentsCount = GraduationFee::whereColumn('amount_paid', '<', 'amount_due')->count();

        // Calculate the total number of students that are unpaid in:
        // Counterparts
        $counterpartUnpaidStudentsCount = Counterpart::where('amount_paid', '=', 0)->count();
        // MedicalShare
        $medicalShareUnpaidStudentsCount = MedicalShare::where('amount_paid', '=', 0)->count();
        // Personal Cash Advance
        $personalCashAdvancetUnpaidStudentsCount = PersonalCashAdvance::where('amount_paid', '=', 0)->count();
        // Graduation Fee
        $graduationFeeUnpaidStudentsCount = GraduationFee::where('amount_paid', '=', 0)->count();

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

        // Calculate the percentage for each category per month
        // January
        $medicalSharePaidCountJanuary = MedicalShare::where('amount_paid', '>', 0)->whereMonth('created_at', '01')->count();
        $medicalSharePaidCountJanuary = $medicalSharePaidCountJanuary / $totalNumberOfStudents * 100;
        $counterpartPaidCountJanuary = Counterpart::where('amount_paid', '>', 0)->where('month', '1')->count();
        $counterpartPaidCountJanuary = $counterpartPaidCountJanuary / $totalNumberOfStudents * 100;
        $graduationFeePaidCountJanuary = GraduationFee::where('amount_paid', '>', 0)->whereMonth('created_at', '01')->count();
        $graduationFeePaidCountJanuary = $graduationFeePaidCountJanuary / $totalNumberOfStudents * 100;
        $personalCashAdvancePaidCountJanuary = PersonalCashAdvance::where('amount_paid', '>', 0)->whereMonth('created_at', '01')->count();
        $personalCashAdvancePaidCountJanuary = $personalCashAdvancePaidCountJanuary / $totalNumberOfStudents * 100;

        // February
        $medicalSharePaidCountFebruary = MedicalShare::where('amount_paid', '>', 0)->whereMonth('created_at', '02')->count();
        $medicalSharePaidCountFebruary = $medicalSharePaidCountFebruary / $totalNumberOfStudents * 100;
        $counterpartPaidCountFebruary = Counterpart::where('amount_paid', '>', 0)->where('month', '2')->count();
        $counterpartPaidCountFebruary = $counterpartPaidCountFebruary / $totalNumberOfStudents * 100;
        $graduationFeePaidCountFebruary = GraduationFee::where('amount_paid', '>', 0)->whereMonth('created_at', '02')->count();
        $graduationFeePaidCountFebruary = $graduationFeePaidCountFebruary / $totalNumberOfStudents * 100;
        $personalCashAdvancePaidCountFebruary = PersonalCashAdvance::where('amount_paid', '>', 0)->whereMonth('created_at', '20')->count();
        $personalCashAdvancePaidCountFebruary = $personalCashAdvancePaidCountFebruary / $totalNumberOfStudents * 100;

        // March
        $medicalSharePaidCountMarch = MedicalShare::where('amount_paid', '>', 0)->whereMonth('created_at', '03')->count();
        $medicalSharePaidCountMarch = $medicalSharePaidCountMarch / $totalNumberOfStudents * 100;
        $counterpartPaidCountMarch = Counterpart::where('amount_paid', '>', 0)->where('month', '3')->count();
        $counterpartPaidCountMarch = $counterpartPaidCountMarch / $totalNumberOfStudents * 100;
        $graduationFeePaidCountMarch = GraduationFee::where('amount_paid', '>', 0)->whereMonth('created_at', '03')->count();
        $graduationFeePaidCountMarch = $graduationFeePaidCountMarch / $totalNumberOfStudents * 100;
        $personalCashAdvancePaidCountMarch = PersonalCashAdvance::where('amount_paid', '>', 0)->whereMonth('created_at', '03')->count();
        $personalCashAdvancePaidCountMarch = $personalCashAdvancePaidCountMarch / $totalNumberOfStudents * 100;

        // April
        $medicalSharePaidCountApril = MedicalShare::where('amount_paid', '', 0)->whereMonth('created_at', '04')->count();
        $medicalSharePaidCountApril = $medicalSharePaidCountApril / $totalNumberOfStudents * 100;
        $counterpartPaidCountApril = Counterpart::where('amount_paid', '>', 0)->where('month', '4')->count();
        $counterpartPaidCountApril = $counterpartPaidCountApril / $totalNumberOfStudents * 100;
        $graduationFeePaidCountApril = GraduationFee::where('amount_paid', '>', 0)->whereMonth('created_at', '04')->count();
        $graduationFeePaidCountApril = $graduationFeePaidCountApril / $totalNumberOfStudents * 100;
        $personalCashAdvancePaidCountApril = PersonalCashAdvance::where('amount_paid', '>', 0)->whereMonth('created_at', '04')->count();
        $personalCashAdvancePaidCountApril = $personalCashAdvancePaidCountApril / $totalNumberOfStudents * 100;

        // May
        $medicalSharePaidCountMay = MedicalShare::where('amount_paid', '>', 0)->whereMonth('created_at', '05')->count();
        $medicalSharePaidCountMay = $medicalSharePaidCountMay / $totalNumberOfStudents * 100;
        $counterpartPaidCountMay = Counterpart::where('amount_paid', '>', 0)->where('month', '5')->count();
        $counterpartPaidCountMay = $counterpartPaidCountMay / $totalNumberOfStudents * 100;
        $graduationFeePaidCountMay = GraduationFee::where('amount_paid', '>', 0)->whereMonth('created_at', '05')->count();
        $graduationFeePaidCountMay = $graduationFeePaidCountMay / $totalNumberOfStudents * 100;
        $personalCashAdvancePaidCountMay = PersonalCashAdvance::where('amount_paid', '>', 0)->whereMonth('created_at', '05')->count();
        $personalCashAdvancePaidCountMay = $personalCashAdvancePaidCountMay / $totalNumberOfStudents * 100;

        // June
        $medicalSharePaidCountJune = MedicalShare::where('amount_paid', '>', 0)->whereMonth('created_at', '06')->count();
        $medicalSharePaidCountJune = $medicalSharePaidCountJune / $totalNumberOfStudents * 100;
        $counterpartPaidCountJune = Counterpart::where('amount_paid', '>', 0)->where('month', '6')->count();
        $counterpartPaidCountJune = $counterpartPaidCountJune / $totalNumberOfStudents * 100;
        $graduationFeePaidCountJune = GraduationFee::where('amount_paid', '>', 0)->whereMonth('created_at', '06')->count();
        $graduationFeePaidCountJune = $graduationFeePaidCountJune / $totalNumberOfStudents * 100;
        $personalCashAdvancePaidCountJune = PersonalCashAdvance::where('amount_paid', '>', 0)->whereMonth('created_at', '06')->count();
        $personalCashAdvancePaidCountJune = $graduationFeePaidCountJune / $totalNumberOfStudents * 100;

        // July
        $medicalSharePaidCountJuly = MedicalShare::where('amount_paid', '>', 0)->whereMonth('created_at', '07')->count();
        $medicalSharePaidCountJuly = $medicalSharePaidCountJuly / $totalNumberOfStudents * 100;
        $counterpartPaidCountJuly = Counterpart::where('amount_paid', '>', 0)->where('month', '7')->count();
        $counterpartPaidCountJuly = $counterpartPaidCountJuly / $totalNumberOfStudents * 100;
        $graduationFeePaidCountJuly = GraduationFee::where('amount_paid', '>', 0)->whereMonth('created_at', '07')->count();
        $graduationFeePaidCountJuly = $graduationFeePaidCountJuly / $totalNumberOfStudents * 100;
        $personalCashAdvancePaidCountJuly = PersonalCashAdvance::where('amount_paid', '>', 0)->whereMonth('created_at', '07')->count();
        $personalCashAdvancePaidCountJuly = $personalCashAdvancePaidCountJuly / $totalNumberOfStudents * 100;

        // August
        $medicalSharePaidCountAugust = MedicalShare::where('amount_paid', '>', 0)->whereMonth('created_at', '08')->count();
        $medicalSharePaidCountAugust = $medicalSharePaidCountAugust / $totalNumberOfStudents * 100;
        $counterpartPaidCountAugust = Counterpart::where('amount_paid', '>', 0)->where('month', '8')->count();
        $counterpartPaidCountAugust = $counterpartPaidCountAugust / $totalNumberOfStudents * 100;
        $graduationFeePaidCountAugust = GraduationFee::where('amount_paid', '>', 0)->whereMonth('created_at', '08')->count();
        $graduationFeePaidCountAugust = $graduationFeePaidCountAugust / $totalNumberOfStudents * 100;
        $personalCashAdvancePaidCountAugust = PersonalCashAdvance::where('amount_paid', '>', 0)->whereMonth('created_at', '08')->count();
        $personalCashAdvancePaidCountAugust = $personalCashAdvancePaidCountAugust / $totalNumberOfStudents * 100;

        // September
        $medicalSharePaidCountSeptember = MedicalShare::where('amount_paid', '>', 0)->whereMonth('created_at', '09')->count();
        $medicalSharePaidCountSeptember = $medicalSharePaidCountSeptember / $totalNumberOfStudents * 100;
        $counterpartPaidCountSeptember = Counterpart::where('amount_paid', '>', 0)->where('month', '9')->count();
        $counterpartPaidCountSeptember = $counterpartPaidCountSeptember / $totalNumberOfStudents * 100;
        $graduationFeePaidCountSeptember = GraduationFee::where('amount_paid', '>', 0)->whereMonth('created_at', '09')->count();
        $graduationFeePaidCountSeptember = $graduationFeePaidCountSeptember / $totalNumberOfStudents * 100;
        $personalCashAdvancePaidCountSeptember = PersonalCashAdvance::where('amount_paid', '>', 0)->whereMonth('created_at', '09')->count();
        $personalCashAdvancePaidCountSeptember = $personalCashAdvancePaidCountSeptember / $totalNumberOfStudents * 100;

        // October
        $medicalSharePaidCountOctober = MedicalShare::where('amount_paid', '>', 0)->whereMonth('created_at', '10')->count();
        $medicalSharePaidCountOctober = $medicalSharePaidCountOctober / $totalNumberOfStudents * 100;
        $counterpartPaidCountOctober = Counterpart::where('amount_paid', '>', 0)->where('month', '10')->count();
        $counterpartPaidCountOctober = $counterpartPaidCountOctober / $totalNumberOfStudents * 100;
        $graduationFeePaidCountOctober = GraduationFee::where('amount_paid', '>', 0)->whereMonth('created_at', '10')->count();
        $graduationFeePaidCountOctober = $graduationFeePaidCountOctober / $totalNumberOfStudents * 100;
        $personalCashAdvancePaidCountOctober = PersonalCashAdvance::where('amount_paid', '>', 0)->whereMonth('created_at', '10')->count();
        $personalCashAdvancePaidCountOctober = $personalCashAdvancePaidCountOctober / $totalNumberOfStudents * 100;

        // November
        $medicalSharePaidCountNovember = MedicalShare::where('amount_paid', '>', 0)->whereMonth('created_at', '11')->count();
        $medicalSharePaidCountNovember = $medicalSharePaidCountNovember / $totalNumberOfStudents * 100;
        $counterpartPaidCountNovember = Counterpart::where('amount_paid', '>', 0)->where('month', '11')->count();
        $counterpartPaidCountNovember = $counterpartPaidCountNovember / $totalNumberOfStudents * 100;
        $graduationFeePaidCountNovember = GraduationFee::where('amount_paid', '>', 0)->whereMonth('created_at', '11')->count();
        $graduationFeePaidCountNovember = $graduationFeePaidCountNovember / $totalNumberOfStudents * 100;
        $personalCashAdvancePaidCountNovember = PersonalCashAdvance::where('amount_paid', '>', 0)->whereMonth('created_at', '11')->count();
        $personalCashAdvancePaidCountNovember = $personalCashAdvancePaidCountNovember / $totalNumberOfStudents * 100;

        // December
        $medicalSharePaidCountDecember = MedicalShare::where('amount_paid', '>', 0)->whereMonth('created_at', '12')->count();
        $medicalSharePaidCountDecember = $medicalSharePaidCountDecember / $totalNumberOfStudents * 100;
        $counterpartPaidCountDecember = Counterpart::where('amount_paid', '>', 0)->where('month', '12')->count();
        $counterpartPaidCountDecember = $counterpartPaidCountDecember / $totalNumberOfStudents * 100;
        $graduationFeePaidCountDecember = GraduationFee::where('amount_paid', '>', 0)->whereMonth('created_at', '12')->count();
        $graduationFeePaidCountDecember = $graduationFeePaidCountDecember / $totalNumberOfStudents * 100;
        $personalCashAdvancePaidCountDecember = PersonalCashAdvance::where('amount_paid', '>', 0)->whereMonth('created_at', '12')->count();
        $personalCashAdvancePaidCountDecember = $personalCashAdvancePaidCountDecember / $totalNumberOfStudents * 100;

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
            'totalNumberOfStudents' => $totalNumberOfStudents,
            // Medical
            'medicalSharePaidCountJanuary' => $medicalSharePaidCountJanuary,
            'medicalSharePaidCountFebruary' => $medicalSharePaidCountFebruary,
            'medicalSharePaidCountMarch' => $medicalSharePaidCountMarch,
            'medicalSharePaidCountApril' => $medicalSharePaidCountApril,
            'medicalSharePaidCountMay' => $medicalSharePaidCountMay,
            'medicalSharePaidCountJune' => $medicalSharePaidCountJune,
            'medicalSharePaidCountJuly' => $medicalSharePaidCountJuly,
            'medicalSharePaidCountAugust' => $medicalSharePaidCountAugust,
            'medicalSharePaidCountSeptember' => $medicalSharePaidCountSeptember,
            'medicalSharePaidCountOctober' => $medicalSharePaidCountOctober,
            'medicalSharePaidCountNovember' => $medicalSharePaidCountNovember,
            'medicalSharePaidCountDecember' => $medicalSharePaidCountDecember,
            // Counterpart
            'counterpartPaidCountJanuary' => $counterpartPaidCountJanuary,
            'counterpartPaidCountFebruary' => $counterpartPaidCountFebruary,
            'counterpartPaidCountMarch' => $counterpartPaidCountMarch,
            'counterpartPaidCountApril' => $counterpartPaidCountApril,
            'counterpartPaidCountMay' => $counterpartPaidCountMay,
            'counterpartPaidCountJune' => $counterpartPaidCountJune,
            'counterpartPaidCountJuly' => $counterpartPaidCountJuly,
            'counterpartPaidCountAugust' => $counterpartPaidCountAugust,
            'counterpartPaidCountSeptember' => $counterpartPaidCountSeptember,
            'counterpartPaidCountOctober' => $counterpartPaidCountOctober,
            'counterpartPaidCountNovember' => $counterpartPaidCountNovember,
            'counterpartPaidCountDecember' => $counterpartPaidCountDecember,
            // Graduation Fee
            'graduationFeePaidCountJanuary' => $graduationFeePaidCountJanuary,
            'graduationFeePaidCountFebruary' => $graduationFeePaidCountFebruary,
            'graduationFeePaidCountMarch' => $graduationFeePaidCountMarch,
            'graduationFeePaidCountApril' => $graduationFeePaidCountApril,
            'graduationFeePaidCountMay' => $graduationFeePaidCountMay,
            'graduationFeePaidCountJune' => $graduationFeePaidCountJune,
            'graduationFeePaidCountJuly' => $graduationFeePaidCountJuly,
            'graduationFeePaidCountAugust' => $graduationFeePaidCountAugust,
            'graduationFeePaidCountSeptember' => $graduationFeePaidCountSeptember,
            'graduationFeePaidCountOctober' => $graduationFeePaidCountOctober,
            'graduationFeePaidCountNovember' => $graduationFeePaidCountNovember,
            'graduationFeePaidCountDecember' => $graduationFeePaidCountDecember,
            // Personal Cash Advance
            'personalCashAdvancePaidCountJanuary' => $personalCashAdvancePaidCountJanuary,
            'personalCashAdvancePaidCountFebruary' => $personalCashAdvancePaidCountFebruary,
            'personalCashAdvancePaidCountMarch' => $personalCashAdvancePaidCountMarch,
            'personalCashAdvancePaidCountApril' => $personalCashAdvancePaidCountApril,
            'personalCashAdvancePaidCountMay' => $personalCashAdvancePaidCountMay,
            'personalCashAdvancePaidCountJune' => $personalCashAdvancePaidCountJune,
            'personalCashAdvancePaidCountJuly' => $personalCashAdvancePaidCountJuly,
            'personalCashAdvancePaidCountAugust' => $personalCashAdvancePaidCountAugust,
            'personalCashAdvancePaidCountSeptember' => $personalCashAdvancePaidCountSeptember,
            'personalCashAdvancePaidCountOctober' => $personalCashAdvancePaidCountOctober,
            'personalCashAdvancePaidCountNovember' => $personalCashAdvancePaidCountNovember,
            'personalCashAdvancePaidCountDecember' => $personalCashAdvancePaidCountDecember,
            // Analytics
            'totalNumberOfStudents' => $totalNumberOfStudents,
            'counterpartPaidStudentsCount' => $counterpartPaidStudentsCount,
            'medicalSharePaidStudentsCount' => $medicalSharePaidStudentsCount,
            'personalCashAdvancePaidStudentsCount' => $personalCashAdvancePaidStudentsCount,
            'personalCashAdvanceNotFullyPaidStudentsCount' => $personalCashAdvanceNotFullyPaidStudentsCount,
            'graduationFeePaidStudentsCount' => $graduationFeePaidStudentsCount,
            'graduationFeeNotFullyPaidStudentsCount' => $graduationFeeNotFullyPaidStudentsCount,
            'counterpartUnpaidStudentsCount' => $counterpartUnpaidStudentsCount,
            'medicalShareUnpaidStudentsCount' => $medicalShareUnpaidStudentsCount,
            'personalCashAdvanceUnpaidStudentsCount' => $personalCashAdvancetUnpaidStudentsCount,
            'graduationFeeUnpaidStudentsCount' => $graduationFeeUnpaidStudentsCount,
            'medicalShareNotFullyPaidStudentsCount' => $medicalShareNotFullyPaidStudentsCount,
            'counterpartNotFullyPaidStudentsCount' => $counterpartNotFullyPaidStudentsCount,
            'batchYears' => $batchYears,
            'totalStudentsByBatchYear' => $totalStudentsByBatchYear,
        ]);
    }

    // public function getTotals(Request $request)
    // {
    //     $batchYear = $request->input('batch_year');

    //     // Counterpart
    //     $totalPaidCounterpart = Student::where('batch_year', $batchYear)
    //         ->whereHas('counterpart', function ($query) {
    //             $query->whereColumn('amount_paid', '=', 'amount_due');
    //         })
    //         ->count();

    //     $totalNotFullyPaidCounterpart = Student::where('batch_year', $batchYear)
    //         ->whereHas('counterpart', function ($query) {
    //             $query->whereColumn('amount_paid', '=', 'amount_due');
    //         })
    //         ->count(); // Modify the query as needed

    //     $totalUnpaidCounterpart = Student::where('batch_year', $batchYear)
    //         ->whereHas('counterpart', function ($query) {
    //             $query->whereColumn('amount_paid', '!=', 'amount_due');
    //         })
    //         ->where('category', 'Counterpart')
    //         ->count(); // Modify the query as needed

    //     // Medical Share
    //     $totalPaidMedicalShare = Student::where('batch_year', $batchYear)
    //         ->whereHas('counterpart', function ($query) {
    //             $query->whereColumn('amount_paid', '=', 'amount_due');
    //         })
    //         ->where('category', 'Medical Share')
    //         ->count();

    //     $totalFullyPaidMedicalShare = Student::where('batch_year', $batchYear)
    //         ->whereHas('counterpart', function ($query) {
    //             $query->whereColumn('amount_paid', '=', 'amount_due');
    //         })
    //         ->where('category', 'Medical Share')
    //         ->count(); // Modify the query as needed

    //     $totalUnpaidMedicalShare = Student::where('batch_year', $batchYear)
    //         ->whereHas('counterpart', function ($query) {
    //             $query->whereColumn('amount_paid', '!=', 'amount_due');
    //         })
    //         ->where('category', 'Medical Share')
    //         ->count(); // Modify the query as needed

    //     $totalPaidPersonalCashAdvance = Student::where('batch_year', $batchYear)
    //         ->whereHas('counterpart', function ($query) {
    //             $query->whereColumn('amount_paid', '=', 'amount_due');
    //         })
    //         ->where('category', 'Personal Cash Advance')
    //         ->count();

    //     $totalFullyPaidPersonalCashAdvance = Student::where('batch_year', $batchYear)
    //         ->whereHas('counterpart', function ($query) {
    //             $query->whereColumn('amount_paid', '=', 'amount_due');
    //         })
    //         ->where('category', 'Personal Cash Advance')
    //         ->count(); // Modify the query as needed

    //     $totalUnpaidPersonalCashAdvance = Student::where('batch_year', $batchYear)
    //         ->whereHas('counterpart', function ($query) {
    //             $query->whereColumn('amount_paid', '!=', 'amount_due');
    //         })
    //         ->where('category', 'Personal Cash Advance')
    //         ->count(); // Modify the query as needed

    //     // Graduation Fees
    //     $totalPaidGraduationFees = Student::where('batch_year', $batchYear)
    //         ->whereHas('counterpart', function ($query) {
    //             $query->whereColumn('amount_paid', '=', 'amount_due');
    //         })
    //         ->where('category', 'Graduation Fees')
    //         ->count();

    //     $totalFullyPaidGraduationFees = Student::where('batch_year', $batchYear)
    //         ->whereHas('counterpart', function ($query) {
    //             $query->whereColumn('amount_paid', '=', 'amount_due');
    //         })
    //         ->where('category', 'Graduation Fees')
    //         ->count(); // Modify the query as needed

    //     $totalUnpaidGraduationFees = Student::where('batch_year', $batchYear)
    //         ->whereHas('counterpart', function ($query) {
    //             $query->whereColumn('amount_paid', '!=', 'amount_due');
    //         })
    //         ->where('category', 'Graduation Fees')
    //         ->count(); // Modify the query as needed

    //     return response()->json([
    //         'totalPaidCounterpart' => $totalPaidCounterpart,
    //         'totalUnpaidCounterpart' => $totalUnpaidCounterpart,
    //         'totalNotFullyPaidCounterpart' => $totalNotFullyPaidCounterpart,
    //     ]);
    // }

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

            // Retrieve the student's counterpart balance
            if ($student->counterpart) {
                $amountDue = $student->counterpart
                    ->sum('amount_due');

                $amountPaid = $student->counterpart
                    ->sum('amount_paid');

                $counterpartBalance = $amountDue - $amountPaid;
            }

            // Retrieve the student's medical share balance
            if ($student->medicalShare) {
                $totalCost = $student->medicalShare
                    ->sum('total_cost');

                $amountPaid = $student->medicalShare
                    ->sum('amount_paid');

                $medicalShareBalance = ($totalCost * 0.15) - $amountPaid;
            }

            $counterpartBalance = $counterpartBalance ?? 0.00;
            $medicalShareBalance = $medicalShareBalance ?? 0.00;

            $total = $counterpartBalance + $medicalShareBalance;

            Mail::to($student->email)->send(new SendEmailPayable($student_name, $month, $year, $counterpartBalance, $medicalShareBalance, $total));
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
}
