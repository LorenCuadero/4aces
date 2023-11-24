<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Counterpart;
use App\Models\GraduationFee;
use App\Models\MedicalShare;
use App\Models\PersonalCashAdvance;
use Illuminate\Http\Request;

//
class FinancialReportController extends Controller
{
    public function index()
    {
        $counterpartTotal = Counterpart::sum('amount_paid');
        $medicalShareTotal = MedicalShare::sum('amount_paid');
        $graduationFeeTotal = GraduationFee::sum('amount_paid');
        $personalCashAdvanceTotal = PersonalCashAdvance::sum('amount_paid');

        $total = $counterpartTotal + $medicalShareTotal + $graduationFeeTotal + $personalCashAdvanceTotal;

        return view('pages.admin-auth.financial-reports.index',
            compact(
                'counterpartTotal',
                'medicalShareTotal',
                'graduationFeeTotal',
                'personalCashAdvanceTotal',
                'total'));
    }

    public function viewFinancialReportByDateFromAndTo(Request $request)
    {
        $dateFrom = $request->input('dateFrom');
        $dateTo = $request->input('dateTo');

        $counterpartTotal = Counterpart::whereBetween('date', [$dateFrom, $dateTo])->sum('amount_paid');
        $medicalShareTotal = MedicalShare::whereBetween('date', [$dateFrom, $dateTo])->sum('amount_paid');
        $graduationFeeTotal = GraduationFee::whereBetween('date', [$dateFrom, $dateTo])->sum('amount_paid');
        $personalCashAdvanceTotal = PersonalCashAdvance::whereBetween('date', [$dateFrom, $dateTo])->sum('amount_paid');

        $total = $counterpartTotal + $medicalShareTotal + $graduationFeeTotal + $personalCashAdvanceTotal;

        $dateFrom = date('F d, Y', strtotime($dateFrom));
        $dateTo = date('F d, Y', strtotime($dateTo));

        return view('pages.admin-auth.financial-reports.index',
            compact(
                'counterpartTotal',
                'medicalShareTotal',
                'graduationFeeTotal',
                'personalCashAdvanceTotal',
                'total',
                'dateFrom',
                'dateTo'));
    }
}
