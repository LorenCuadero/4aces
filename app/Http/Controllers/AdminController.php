<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Mail\SendClosingOfAccountsEmail;
use App\Mail\SendEmailPayable;
use App\Models\Counterpart;
use App\Models\GraduationFee;
use App\Models\MedicalShare;
use App\Models\PersonalCashAdvance;
use App\Models\Student;
use dateTime;
use DB;
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
        $counterpartPaidStudentsCount = Counterpart::whereIn('student_id', function ($query) {
            $query->select('student_id')
                ->from('counterparts')
                ->whereColumn('amount_paid', '=', 'amount_due')
                ->groupBy('student_id');
        })->distinct()->count('student_id');

        // MedicalShare
        $medicalSharePaidStudentsCount = MedicalShare::whereIn('student_id', function ($query) {
            $query->select('student_id')
                ->from('medical_shares')
                ->whereColumn('amount_paid', '=', \DB::raw('total_cost * 0.15'))
                ->groupBy('student_id');
        })->distinct()->count('student_id');

        // Personal Cash Advance
        $personalCashAdvancePaidStudentsCount = PersonalCashAdvance::whereIn('student_id', function ($query) {
            $query->select('student_id')
                ->from('personal_cash_advances')
                ->whereColumn('amount_paid', '=', 'amount_due')
                ->groupBy('student_id');
        })->distinct()->count('student_id');

        // Graduation Fee
        $graduationFeePaidStudentsCount = GraduationFee::whereIn('student_id', function ($query) {
            $query->select('student_id')
                ->from('graduation_fees')
                ->whereColumn('amount_paid', '=', 'amount_due')
                ->groupBy('student_id');
        })->distinct()->count('student_id');

        // Calculate the total number of students that are not fully paid in counterparts
        // Counterpart
        $counterpartNotFullyPaidStudentsCount = Counterpart::whereIn('student_id', function ($query) {
            $query->select('student_id')
                ->from('counterparts')
                ->whereColumn('amount_paid', '<', 'amount_due')
                ->groupBy('student_id');
        })->distinct()->count('student_id');

        // MedicalShare Not Fully Paid Students
        $medicalShareNotFullyPaidStudentsCount = MedicalShare::whereIn('student_id', function ($query) {
            $query->select('student_id')
                ->from('medical_shares')
                ->whereColumn('amount_paid', '<', \DB::raw('total_cost * 0.15'))
                ->groupBy('student_id');
        })->distinct()->count('student_id');

        // Personal Cash Advance Not Fully Paid Students
        $personalCashAdvanceNotFullyPaidStudentsCount = PersonalCashAdvance::whereIn('student_id', function ($query) {
            $query->select('student_id')
                ->from('personal_cash_advances')
                ->whereColumn('amount_paid', '<', 'amount_due')
                ->groupBy('student_id');
        })->distinct()->count('student_id');

        // Graduation Fee Not Fully Paid Students
        $graduationFeeNotFullyPaidStudentsCount = GraduationFee::whereIn('student_id', function ($query) {
            $query->select('student_id')
                ->from('graduation_fees')
                ->whereColumn('amount_paid', '<', 'amount_due')
                ->groupBy('student_id');
        })->distinct()->count('student_id');

        // Calculate the total number of students that are unpaid in:
        // Counterparts
        $counterpartUnpaidStudentsCount = Counterpart::whereIn('student_id', function ($query) {
            $query->select('student_id')
                ->from('counterparts')
                ->where('amount_paid', '=', 0)
                ->groupBy('student_id');
        })->distinct()->count('student_id');

        // MedicalShare
        $medicalShareUnpaidStudentsCount = MedicalShare::whereIn('student_id', function ($query) {
            $query->select('student_id')
                ->from('medical_shares')
                ->where('amount_paid', '=', 0)
                ->groupBy('student_id');
        })->distinct()->count('student_id');

        // Personal Cash Advance
        $personalCashAdvancetUnpaidStudentsCount = PersonalCashAdvance::whereIn('student_id', function ($query) {
            $query->select('student_id')
                ->from('personal_cash_advances')
                ->where('amount_paid', '=', 0)
                ->groupBy('student_id');
        })->distinct()->count('student_id');

        // Graduation Fee
        $graduationFeeUnpaidStudentsCount = GraduationFee::whereIn('student_id', function ($query) {
            $query->select('student_id')
                ->from('graduation_fees')
                ->where('amount_paid', '=', 0)
                ->groupBy('student_id');
        })->distinct()->count('student_id');

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
        $medicalSharePaidCountJanuary = MedicalShare::where('amount_paid', '>', 0)
            ->whereMonth('date', 1)
            ->select('student_id')
            ->distinct()
            ->get();
        $uniqueStudentsMedicalSharePaidJanuary = $medicalSharePaidCountJanuary->count();
        $medicalSharePaidCountJanuary = $uniqueStudentsMedicalSharePaidJanuary / $totalNumberOfStudents * 100;

        $studentsWithCounterpartPaidJanuary = Counterpart::where('amount_paid', '>', 0)
            ->whereMonth('date', 1)
            ->select('student_id')
            ->distinct()
            ->get();
        $uniqueStudentsCounterpartPaidJanuary = $studentsWithCounterpartPaidJanuary->count();
        $counterpartPaidCountJanuary = ($uniqueStudentsCounterpartPaidJanuary / $totalNumberOfStudents) * 100;

        $graduationFeePaidCountJanuary = GraduationFee::where('amount_paid', '>', 0)
            ->whereMonth('date', 1)
            ->select('student_id')
            ->distinct()
            ->get();
        $uniqueStudentsGraduationFeePaidJanuary = $graduationFeePaidCountJanuary->count();
        $graduationFeePaidCountJanuary = $uniqueStudentsGraduationFeePaidJanuary / $totalNumberOfStudents * 100;

        $personalCashAdvancePaidCountJanuary = PersonalCashAdvance::where('amount_paid', '>', 0)
            ->whereMonth('date', 1)
            ->select('student_id')
            ->distinct()
            ->get();
        $uniqueStudentsPersonalCashAdvancePaidJanuary = $personalCashAdvancePaidCountJanuary->count();
        $personalCashAdvancePaidCountJanuary = $uniqueStudentsPersonalCashAdvancePaidJanuary / $totalNumberOfStudents * 100;

        // February
        $medicalSharePaidCountFebruary = MedicalShare::where('amount_paid', '>', 0)
            ->whereMonth('date', 2)
            ->select('student_id')
            ->distinct()
            ->get();
        $uniqueStudentsMedicalSharePaidFebruary = $medicalSharePaidCountFebruary->count();
        $medicalSharePaidCountFebruary = $uniqueStudentsMedicalSharePaidFebruary / $totalNumberOfStudents * 100;

        $studentsWithCounterpartPaidFebruary = Counterpart::where('amount_paid', '>', 0)
            ->whereMonth('date', 2)
            ->select('student_id')
            ->distinct()
            ->get();
        $uniqueStudentsCounterpartPaidFebruary = $studentsWithCounterpartPaidFebruary->count();
        $counterpartPaidCountFebruary = ($uniqueStudentsCounterpartPaidFebruary / $totalNumberOfStudents) * 100;

        $graduationFeePaidCountFebruary = GraduationFee::where('amount_paid', '>', 0)
            ->whereMonth('date', 2)
            ->select('student_id')
            ->distinct()
            ->get();
        $uniqueStudentsGraduationFeePaidJanuary = $graduationFeePaidCountFebruary->count();
        $graduationFeePaidCountFebruary = $uniqueStudentsGraduationFeePaidJanuary / $totalNumberOfStudents * 100;

        $personalCashAdvancePaidCountFebruary = PersonalCashAdvance::where('amount_paid', '>', 0)
            ->whereMonth('date', 2)
            ->select('student_id')
            ->distinct()
            ->get();
        $uniqueStudentsPersonalCashAdvancePaidFebruary = $personalCashAdvancePaidCountFebruary->count();
        $personalCashAdvancePaidCountFebruary = $uniqueStudentsPersonalCashAdvancePaidFebruary / $totalNumberOfStudents * 100;

        // March
        $medicalSharePaidCountMarch = MedicalShare::where('amount_paid', '>', 0)
            ->whereMonth('date', 3)
            ->select('student_id')
            ->distinct()
            ->get();
        $uniqueStudentsMedicalSharePaidMarch = $medicalSharePaidCountMarch->count();
        $medicalSharePaidCountMarch = ($uniqueStudentsMedicalSharePaidMarch / $totalNumberOfStudents) * 100;

        $studentsWithCounterpartPaidMarch = Counterpart::where('amount_paid', '>', 0)
            ->whereMonth('date', 3)
            ->select('student_id')
            ->distinct()
            ->get();
        $uniqueStudentsCounterpartPaidMarch = $studentsWithCounterpartPaidMarch->count();
        $counterpartPaidCountMarch = ($uniqueStudentsCounterpartPaidMarch / $totalNumberOfStudents) * 100;

        $graduationFeePaidCountMarch = GraduationFee::where('amount_paid', '>', 0)
            ->whereMonth('date', 3)
            ->select('student_id')
            ->distinct()
            ->get();
        $uniqueStudentsGraduationFeePaidMarch = $graduationFeePaidCountMarch->count();
        $graduationFeePaidCountMarch = ($uniqueStudentsGraduationFeePaidMarch / $totalNumberOfStudents) * 100;

        $personalCashAdvancePaidCountMarch = PersonalCashAdvance::where('amount_paid', '>', 0)
            ->whereMonth('date', 3)
            ->select('student_id')
            ->distinct()
            ->get();
        $uniqueStudentsPersonalCashAdvancePaidMarch = $personalCashAdvancePaidCountMarch->count();
        $personalCashAdvancePaidCountMarch = ($uniqueStudentsPersonalCashAdvancePaidMarch / $totalNumberOfStudents) * 100;

        // April
        $medicalSharePaidCountApril = MedicalShare::where('amount_paid', '>', 0)
            ->whereMonth('date', 4)
            ->select('student_id')
            ->distinct()
            ->get();
        $uniqueStudentsMedicalSharePaidApril = $medicalSharePaidCountApril->count();
        $medicalSharePaidCountApril = ($uniqueStudentsMedicalSharePaidApril / $totalNumberOfStudents) * 100;

        $studentsWithCounterpartPaidApril = Counterpart::where('amount_paid', '>', 0)
            ->whereMonth('date', 4)
            ->select('student_id')
            ->distinct()
            ->get();
        $uniqueStudentsCounterpartPaidApril = $studentsWithCounterpartPaidApril->count();
        $counterpartPaidCountApril = ($uniqueStudentsCounterpartPaidApril / $totalNumberOfStudents) * 100;

        $graduationFeePaidCountApril = GraduationFee::where('amount_paid', '>', 0)
            ->whereMonth('date', 4)
            ->select('student_id')
            ->distinct()
            ->get();
        $uniqueStudentsGraduationFeePaidApril = $graduationFeePaidCountApril->count();
        $graduationFeePaidCountApril = ($uniqueStudentsGraduationFeePaidApril / $totalNumberOfStudents) * 100;

        $personalCashAdvancePaidCountApril = PersonalCashAdvance::where('amount_paid', '>', 0)
            ->whereMonth('date', 4)
            ->select('student_id')
            ->distinct()
            ->get();
        $uniqueStudentsPersonalCashAdvancePaidApril = $personalCashAdvancePaidCountApril->count();
        $personalCashAdvancePaidCountApril = ($uniqueStudentsPersonalCashAdvancePaidApril / $totalNumberOfStudents) * 100;

        // May
        $medicalSharePaidCountMay = MedicalShare::where('amount_paid', '>', 0)
            ->whereMonth('date', 5)
            ->select('student_id')
            ->distinct()
            ->get();
        $uniqueStudentsMedicalSharePaidMay = $medicalSharePaidCountMay->count();
        $medicalSharePaidCountMay = ($uniqueStudentsMedicalSharePaidMay / $totalNumberOfStudents) * 100;

        $studentsWithCounterpartPaidMay = Counterpart::where('amount_paid', '>', 0)
            ->whereMonth('date', 5)
            ->select('student_id')
            ->distinct()
            ->get();
        $uniqueStudentsCounterpartPaidMay = $studentsWithCounterpartPaidMay->count();
        $counterpartPaidCountMay = ($uniqueStudentsCounterpartPaidMay / $totalNumberOfStudents) * 100;

        $graduationFeePaidCountMay = GraduationFee::where('amount_paid', '>', 0)
            ->whereMonth('date', 5)
            ->select('student_id')
            ->distinct()
            ->get();
        $uniqueStudentsGraduationFeePaidMay = $graduationFeePaidCountMay->count();
        $graduationFeePaidCountMay = ($uniqueStudentsGraduationFeePaidMay / $totalNumberOfStudents) * 100;

        $personalCashAdvancePaidCountMay = PersonalCashAdvance::where('amount_paid', '>', 0)
            ->whereMonth('date', 5)
            ->select('student_id')
            ->distinct()
            ->get();
        $uniqueStudentsPersonalCashAdvancePaidMay = $personalCashAdvancePaidCountMay->count();
        $personalCashAdvancePaidCountMay = ($uniqueStudentsPersonalCashAdvancePaidMay / $totalNumberOfStudents) * 100;

        // June
        $medicalSharePaidCountJune = MedicalShare::where('amount_paid', '>', 0)
            ->whereMonth('date', 6)
            ->select('student_id')
            ->distinct()
            ->get();
        $uniqueStudentsMedicalSharePaidJune = $medicalSharePaidCountJune->count();
        $medicalSharePaidCountJune = ($uniqueStudentsMedicalSharePaidJune / $totalNumberOfStudents) * 100;

        $studentsWithCounterpartPaidJune = Counterpart::where('amount_paid', '>', 0)
            ->whereMonth('date', 6)
            ->select('student_id')
            ->distinct()
            ->get();
        $uniqueStudentsCounterpartPaidJune = $studentsWithCounterpartPaidJune->count();
        $counterpartPaidCountJune = ($uniqueStudentsCounterpartPaidJune / $totalNumberOfStudents) * 100;

        $graduationFeePaidCountJune = GraduationFee::where('amount_paid', '>', 0)
            ->whereMonth('date', 6)
            ->select('student_id')
            ->distinct()
            ->get();
        $uniqueStudentsGraduationFeePaidJune = $graduationFeePaidCountJune->count();
        $graduationFeePaidCountJune = ($uniqueStudentsGraduationFeePaidJune / $totalNumberOfStudents) * 100;

        $personalCashAdvancePaidCountJune = PersonalCashAdvance::where('amount_paid', '>', 0)
            ->whereMonth('date', 6)
            ->select('student_id')
            ->distinct()
            ->get();
        $uniqueStudentsPersonalCashAdvancePaidJune = $personalCashAdvancePaidCountJune->count();
        $personalCashAdvancePaidCountJune = ($uniqueStudentsPersonalCashAdvancePaidJune / $totalNumberOfStudents) * 100;

        // July
        $medicalSharePaidCountJuly = MedicalShare::where('amount_paid', '>', 0)
            ->whereMonth('date', 7)
            ->select('student_id')
            ->distinct()
            ->get();
        $uniqueStudentsMedicalSharePaidJuly = $medicalSharePaidCountJuly->count();
        $medicalSharePaidCountJuly = ($uniqueStudentsMedicalSharePaidJuly / $totalNumberOfStudents) * 100;

        $studentsWithCounterpartPaidJuly = Counterpart::where('amount_paid', '>', 0)
            ->whereMonth('date', 7)
            ->select('student_id')
            ->distinct()
            ->get();
        $uniqueStudentsCounterpartPaidJuly = $studentsWithCounterpartPaidJuly->count();
        $counterpartPaidCountJuly = ($uniqueStudentsCounterpartPaidJuly / $totalNumberOfStudents) * 100;

        $graduationFeePaidCountJuly = GraduationFee::where('amount_paid', '>', 0)
            ->whereMonth('date', 7)
            ->select('student_id')
            ->distinct()
            ->get();
        $uniqueStudentsGraduationFeePaidJuly = $graduationFeePaidCountJuly->count();
        $graduationFeePaidCountJuly = ($uniqueStudentsGraduationFeePaidJuly / $totalNumberOfStudents) * 100;

        $personalCashAdvancePaidCountJuly = PersonalCashAdvance::where('amount_paid', '>', 0)
            ->whereMonth('date', 7)
            ->select('student_id')
            ->distinct()
            ->get();
        $uniqueStudentsPersonalCashAdvancePaidJuly = $personalCashAdvancePaidCountJuly->count();
        $personalCashAdvancePaidCountJuly = ($uniqueStudentsPersonalCashAdvancePaidJuly / $totalNumberOfStudents) * 100;

        // August
        $medicalSharePaidCountAugust = MedicalShare::where('amount_paid', '>', 0)
            ->whereMonth('date', 8)
            ->select('student_id')
            ->distinct()
            ->get();
        $uniqueStudentsMedicalSharePaidAugust = $medicalSharePaidCountAugust->count();
        $medicalSharePaidCountAugust = ($uniqueStudentsMedicalSharePaidAugust / $totalNumberOfStudents) * 100;

        $studentsWithCounterpartPaidAugust = Counterpart::where('amount_paid', '>', 0)
            ->whereMonth('date', 8)
            ->select('student_id')
            ->distinct()
            ->get();
        $uniqueStudentsCounterpartPaidAugust = $studentsWithCounterpartPaidAugust->count();
        $counterpartPaidCountAugust = ($uniqueStudentsCounterpartPaidAugust / $totalNumberOfStudents) * 100;

        $graduationFeePaidCountAugust = GraduationFee::where('amount_paid', '>', 0)
            ->whereMonth('date', 8)
            ->select('student_id')
            ->distinct()
            ->get();
        $uniqueStudentsGraduationFeePaidAugust = $graduationFeePaidCountAugust->count();
        $graduationFeePaidCountAugust = ($uniqueStudentsGraduationFeePaidAugust / $totalNumberOfStudents) * 100;

        $personalCashAdvancePaidCountAugust = PersonalCashAdvance::where('amount_paid', '>', 0)
            ->whereMonth('date', 8)
            ->select('student_id')
            ->distinct()
            ->get();
        $uniqueStudentsPersonalCashAdvancePaidAugust = $personalCashAdvancePaidCountAugust->count();
        $personalCashAdvancePaidCountAugust = ($uniqueStudentsPersonalCashAdvancePaidAugust / $totalNumberOfStudents) * 100;

        // September
        $medicalSharePaidCountSeptember = MedicalShare::where('amount_paid', '>', 0)
            ->whereMonth('date', 9)
            ->select('student_id')
            ->distinct()
            ->get();
        $uniqueStudentsMedicalSharePaidSeptember = $medicalSharePaidCountSeptember->count();
        $medicalSharePaidCountSeptember = ($uniqueStudentsMedicalSharePaidSeptember / $totalNumberOfStudents) * 100;

        $studentsWithCounterpartPaidSeptember = Counterpart::where('amount_paid', '>', 0)
            ->whereMonth('date', 9)
            ->select('student_id')
            ->distinct()
            ->get();
        $uniqueStudentsCounterpartPaidSeptember = $studentsWithCounterpartPaidSeptember->count();
        $counterpartPaidCountSeptember = ($uniqueStudentsCounterpartPaidSeptember / $totalNumberOfStudents) * 100;

        $graduationFeePaidCountSeptember = GraduationFee::where('amount_paid', '>', 0)
            ->whereMonth('date', 9)
            ->select('student_id')
            ->distinct()
            ->get();
        $uniqueStudentsGraduationFeePaidSeptember = $graduationFeePaidCountSeptember->count();
        $graduationFeePaidCountSeptember = ($uniqueStudentsGraduationFeePaidSeptember / $totalNumberOfStudents) * 100;

        $personalCashAdvancePaidCountSeptember = PersonalCashAdvance::where('amount_paid', '>', 0)
            ->whereMonth('date', 9)
            ->select('student_id')
            ->distinct()
            ->get();
        $uniqueStudentsPersonalCashAdvancePaidSeptember = $personalCashAdvancePaidCountSeptember->count();
        $personalCashAdvancePaidCountSeptember = ($uniqueStudentsPersonalCashAdvancePaidSeptember / $totalNumberOfStudents) * 100;

        // October
        $medicalSharePaidCountOctober = MedicalShare::where('amount_paid', '>', 0)
            ->whereMonth('date', 10)
            ->select('student_id')
            ->distinct()
            ->get();
        $uniqueStudentsMedicalSharePaidOctober = $medicalSharePaidCountOctober->count();
        $medicalSharePaidCountOctober = ($uniqueStudentsMedicalSharePaidOctober / $totalNumberOfStudents) * 100;

        $studentsWithCounterpartPaidOctober = Counterpart::where('amount_paid', '>', 0)
            ->whereMonth('date', 10)
            ->select('student_id')
            ->distinct()
            ->get();
        $uniqueStudentsCounterpartPaidOctober = $studentsWithCounterpartPaidOctober->count();
        $counterpartPaidCountOctober = ($uniqueStudentsCounterpartPaidOctober / $totalNumberOfStudents) * 100;

        $graduationFeePaidCountOctober = GraduationFee::where('amount_paid', '>', 0)
            ->whereMonth('date', 10)
            ->select('student_id')
            ->distinct()
            ->get();
        $uniqueStudentsGraduationFeePaidOctober = $graduationFeePaidCountOctober->count();
        $graduationFeePaidCountOctober = ($uniqueStudentsGraduationFeePaidOctober / $totalNumberOfStudents) * 100;

        $personalCashAdvancePaidCountOctober = PersonalCashAdvance::where('amount_paid', '>', 0)
            ->whereMonth('date', 10)
            ->select('student_id')
            ->distinct()
            ->get();
        $uniqueStudentsPersonalCashAdvancePaidOctober = $personalCashAdvancePaidCountOctober->count();
        $personalCashAdvancePaidCountOctober = ($uniqueStudentsPersonalCashAdvancePaidOctober / $totalNumberOfStudents) * 100;

        // November
        $medicalSharePaidCountNovember = MedicalShare::where('amount_paid', '>', 0)
            ->whereMonth('date', 11)
            ->select('student_id')
            ->distinct()
            ->get();
        $uniqueStudentsMedicalSharePaidNovember = $medicalSharePaidCountNovember->count();
        $medicalSharePaidCountNovember = ($uniqueStudentsMedicalSharePaidNovember / $totalNumberOfStudents) * 100;

        $studentsWithCounterpartPaidNovember = Counterpart::where('amount_paid', '>', 0)
            ->whereMonth('date', 11)
            ->select('student_id')
            ->distinct()
            ->get();
        $uniqueStudentsCounterpartPaidNovember = $studentsWithCounterpartPaidNovember->count();
        $counterpartPaidCountNovember = ($uniqueStudentsCounterpartPaidNovember / $totalNumberOfStudents) * 100;

        $graduationFeePaidCountNovember = GraduationFee::where('amount_paid', '>', 0)
            ->whereMonth('date', 11)
            ->select('student_id')
            ->distinct()
            ->get();
        $uniqueStudentsGraduationFeePaidNovember = $graduationFeePaidCountNovember->count();
        $graduationFeePaidCountNovember = ($uniqueStudentsGraduationFeePaidNovember / $totalNumberOfStudents) * 100;

        $personalCashAdvancePaidCountNovember = PersonalCashAdvance::where('amount_paid', '>', 0)
            ->whereMonth('date', 11)
            ->select('student_id')
            ->distinct()
            ->get();
        $uniqueStudentsPersonalCashAdvancePaidNovember = $personalCashAdvancePaidCountNovember->count();
        $personalCashAdvancePaidCountNovember = ($uniqueStudentsPersonalCashAdvancePaidNovember / $totalNumberOfStudents) * 100;

        // December
        $medicalSharePaidCountDecember = MedicalShare::where('amount_paid', '>', 0)
            ->whereMonth('date', 12)
            ->select('student_id')
            ->distinct()
            ->get();
        $uniqueStudentsMedicalSharePaidDecember = $medicalSharePaidCountDecember->count();
        $medicalSharePaidCountDecember = ($uniqueStudentsMedicalSharePaidDecember / $totalNumberOfStudents) * 100;

        $studentsWithCounterpartPaidDecember = Counterpart::where('amount_paid', '>', 0)
            ->whereMonth('date', 12)
            ->select('student_id')
            ->distinct()
            ->get();
        $uniqueStudentsCounterpartPaidDecember = $studentsWithCounterpartPaidDecember->count();
        $counterpartPaidCountDecember = ($uniqueStudentsCounterpartPaidDecember / $totalNumberOfStudents) * 100;

        $graduationFeePaidCountDecember = GraduationFee::where('amount_paid', '>', 0)
            ->whereMonth('date', 12)
            ->select('student_id')
            ->distinct()
            ->get();
        $uniqueStudentsGraduationFeePaidDecember = $graduationFeePaidCountDecember->count();
        $graduationFeePaidCountDecember = ($uniqueStudentsGraduationFeePaidDecember / $totalNumberOfStudents) * 100;

        $personalCashAdvancePaidCountDecember = PersonalCashAdvance::where('amount_paid', '>', 0)
            ->whereMonth('date', 12)
            ->select('student_id')
            ->distinct()
            ->get();
        $uniqueStudentsPersonalCashAdvancePaidDecember = $personalCashAdvancePaidCountDecember->count();
        $personalCashAdvancePaidCountDecember = ($uniqueStudentsPersonalCashAdvancePaidDecember / $totalNumberOfStudents) * 100;

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

    public function getTotals(Request $request)
    {
        $batchYear = $request->input('batch_year');

        // Counterpart
        $sqlCP = "
        SELECT DISTINCT counterparts.student_id
        FROM counterparts
        INNER JOIN students ON counterparts.student_id = students.id
        WHERE counterparts.amount_paid = counterparts.amount_due
        AND students.batch_year = :batch_year
        ";

        $totalPaidCounterpartDB = DB::select($sqlCP, ['batch_year' => $batchYear]);
        $totalPaidCounterpart = count($totalPaidCounterpartDB);

        $totalNoOfStudentNotFullyPaidCounterpart = Counterpart::whereIn('student_id', function ($query) use ($batchYear) {
            $query->select('student_id')
                ->from('counterparts')
                ->whereColumn('amount_paid', '<', 'amount_due')
                ->where('batch_year', $batchYear)
                ->groupBy('student_id');
        })->distinct()->get();
        $totalNotFullyPaidCounterpart = $totalNoOfStudentNotFullyPaidCounterpart->count();

        $totalNoOfStudentUnpaidCounterpart = Counterpart::whereIn('student_id', function ($query) {
            $query->select('student_id')
                ->from('counterparts')
                ->where('amount_paid', '=', 0)
                ->groupBy('student_id');
        })->distinct()->get();
        $totalUnpaidCounterpart = $totalNoOfStudentUnpaidCounterpart->where('batch_year', $batchYear)->count();

        // Medical Share
        $totalStudentsPaidMedical = MedicalShare::whereIn('student_id', function ($query) {
            $query->select('student_id')
                ->from('medical_shares')
                ->whereColumn('amount_paid', '=', \DB::raw('total_cost * 0.15'))
                ->groupBy('student_id');
        })->distinct()->get();
        $totalPaidMedicalShare = $totalStudentsPaidMedical->where('batch_year', $batchYear)->count();

        $totalStudentsNotFullyPaidMedical = MedicalShare::whereIn('student_id', function ($query) {
            $query->select('student_id')
                ->from('medical_shares')
                ->whereColumn('amount_paid', '<', \DB::raw('total_cost * 0.15'))
                ->groupBy('student_id');
        })->distinct()->get();
        $totalNotFullyPaidMedicalShare = $totalStudentsNotFullyPaidMedical->where('batch_year', $batchYear)->count();

        $totalStudentsUnpaidMedical = MedicalShare::whereIn('student_id', function ($query) {
            $query->select('student_id')
                ->from('medical_shares')
                ->where('amount_paid', '=', 0)
                ->groupBy('student_id');
        })->distinct()->get();
        $totalUnpaidMedicalShare = $totalStudentsUnpaidMedical->where('batch_year', $batchYear)->count();

        // Personal Cash Advances
        $totalNoOfStudentPaidPersonalCashAdvance = PersonalCashAdvance::whereIn('student_id', function ($query) {
            $query->select('student_id')
                ->from('personal_cash_advances')
                ->whereColumn('amount_paid', '=', 'amount_due')
                ->groupBy('student_id');
        })->distinct()->get();
        $totalPaidPersonalCashAdvance = $totalNoOfStudentPaidPersonalCashAdvance->where('batch_year', $batchYear)->count();

        $totalNoOfStudentNotFullyPaidPersonalCashAdvance = PersonalCashAdvance::whereIn('student_id', function ($query) {
            $query->select('student_id')
                ->from('personal_cash_advances')
                ->whereColumn('amount_paid', '<', 'amount_due')
                ->groupBy('student_id');
        })->distinct()->get();
        $totalNotFullyPaidPersonalCashAdvance = $totalNoOfStudentNotFullyPaidPersonalCashAdvance->where('batch_year', $batchYear)->count();

        $totalNoOfStudentUnpaidPersonalCashAdvance = PersonalCashAdvance::whereIn('student_id', function ($query) {
            $query->select('student_id')
                ->from('personal_cash_advances')
                ->where('amount_paid', '=', 0)
                ->groupBy('student_id');
        })->distinct()->get();
        $totalUnpaidPersonalCashAdvance = $totalNoOfStudentUnpaidPersonalCashAdvance->where('batch_year', $batchYear)->count();

        // Graduation Fees
        $totalNoOfStudentPaidGraduationFees = GraduationFee::whereIn('student_id', function ($query) {
            $query->select('student_id')
                ->from('graduation_fees')
                ->whereColumn('amount_paid', '=', 'amount_due')
                ->groupBy('student_id');
        })->distinct()->get();
        $totalPaidGraduationFees = $totalNoOfStudentPaidGraduationFees->where('batch_year', $batchYear)->count();

        $totalNoOfStudentNotFullyPaidGraduationFees = GraduationFee::whereIn('student_id', function ($query) {
            $query->select('student_id')
                ->from('graduation_fees')
                ->whereColumn('amount_paid', '<', 'amount_due')
                ->groupBy('student_id');
        })->distinct()->get();
        $totalNotFullyPaidGraduationFees = $totalNoOfStudentNotFullyPaidGraduationFees->where('batch_year', $batchYear)->count();

        $totalNoOfStudentUnpaidGraduationFees = GraduationFee::whereIn('student_id', function ($query) {
            $query->select('student_id')
                ->from('graduation_fees')
                ->where('amount_paid', '=', 0)
                ->groupBy('student_id');
        })->distinct()->get();
        $totalUnpaidGraduationFees = $totalNoOfStudentUnpaidGraduationFees->where('batch_year', $batchYear)->count();

        return response()->json([
            'totalPaidCounterpart' => $totalPaidCounterpart,
            'totalUnpaidCounterpart' => $totalUnpaidCounterpart,
            'totalNotFullyPaidCounterpart' => $totalNotFullyPaidCounterpart,
            'totalPaidMedicalShare' => $totalPaidMedicalShare,
            'totalUnpaidMedicalShare' => $totalUnpaidMedicalShare,
            'totalNotFullyPaidMedicalShare' => $totalNotFullyPaidMedicalShare,
            'totalPaidPersonalCashAdvance' => $totalPaidPersonalCashAdvance,
            'totalUnpaidPersonalCashAdvance' => $totalUnpaidPersonalCashAdvance,
            'totalNotFullyPaidPersonalCashAdvance' => $totalNotFullyPaidPersonalCashAdvance,
            'totalPaidGraduationFees' => $totalPaidGraduationFees,
            'totalNotFullyPaidGraduationFees' => $totalNotFullyPaidGraduationFees,
            'totalUnpaidGraduationFees' => $totalUnpaidGraduationFees,
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
        $selectedBatchYear = $request->selectedBatchYear;
        $graduation_date_value = $request->graduation_date;
        $datetime = new dateTime($graduation_date_value);
        $graduation_date = $datetime->format('F d, Y');

        $students = Student::where('batch_year', $selectedBatchYear)->get();

        foreach ($students as $student) {
            $student_name = $student->first_name . ' ' . $student->last_name;

            // Calculate the balances for counterpart
            $counterpartBalance = $student->counterpart
                ->sum('amount_due') - $student->counterpart->sum('amount_paid');

            // Calculate the balances for medical share
            $medicalShareBalance = ($student->medicalShare->sum('total_cost') * 0.15) - $student->medicalShare->sum('amount_paid');

            // Calculate the balances for personal share
            $personalShareBalance = $student->personalCashAdvance
                ->sum('amount_due') - $student->personalCashAdvance->sum('amount_paid');

            // Calculate the balances for graduation fee
            $graduationFeeBalance = $student->graduationFee
                ->sum('amount_due') - $student->graduationFee->sum('amount_paid');

            // Send the email with the calculated balances
            Mail::to($student->email)->send(
                new SendClosingOfAccountsEmail(
                    $student_name,
                    $graduation_date,
                    $counterpartBalance,
                    $medicalShareBalance,
                    $personalShareBalance,
                    $graduationFeeBalance
                )
            );
        }

        return redirect()->back()->with('success', 'Emails sent successfully');
    }
}
