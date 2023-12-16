<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Academic;
use App\Models\Disciplinary;
use App\Models\Student;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Http\Request;


class StudentParentController extends Controller
{
    public function indexStudent()
    {
        if (Auth::user()->role == '0') {
            $user = Auth::user();
            $userName = '';
            $userFname = '';
            $userMname = '';
            $userLname = '';
            $totalCounterpart = 0;
            $totalMedical = 0;
            $totalPersonalCashAdvance = 0;
            $totalGraduationFee = 0;
            $totalPayables = 0;
            $totalIncome = 0;
            $total = 0;
            $unpaidCounterpartRecords = [];
            $unpaidPersonalCARecords = [];
            $unpaidMedicalRecords = [];
            $unpaidGraduationFeeRecords = [];

            if ($user->role == 0) {
                // Retrieve the student's name and their payable amounts using the relationship
                $student = $user->student;

                if ($student) {
                    $userName = $student->first_name;
                    $userFname = $student->first_name;
                    $userMname = $student->middle_name;
                    $userLname = $student->last_name;

                    // Calculate the total payable for counterpart
                    $totalCounterpart = $student->counterpart
                        ->sum('amount_due') - $student->counterpart->sum('amount_paid');

                    // Calculate the total payable for medical share
                    $totalMedical = ($student->medicalShare->sum('total_cost') * 0.15) - $student->medicalShare->sum('amount_paid');

                    // Calculate the total payable for personal cash advance
                    $totalPersonalCashAdvance = $student->personalCashAdvance
                        ->sum('amount_due') - $student->personalCashAdvance->sum('amount_paid');

                    // Calculate the total payable for graduation fee
                    $totalGraduationFee = $student->graduationFee
                        ->sum('amount_due') - $student->graduationFee->sum('amount_paid');

                    $totalPayables = $totalCounterpart + $totalMedical + $totalPersonalCashAdvance + $totalGraduationFee;

                    $unpaidCounterpartRecords = $student->counterpart;
                    // dd($unpaidCounterpartRecords->all());

                    $unpaidMedicalRecords = $student->medicalShare;
                    // dd($unpaidMedicalRecords);

                    $unpaidPersonalCARecords = $student->personalCashAdvance;

                    $unpaidGraduationFeeRecords = $student->graduationFee;

                    // dd($totalPayables);
                }
            } else {
                $userName = $user->name;
            }

            return view('pages.student-parent-auth.payable.index', compact('userName', 'userFname', 'userMname', 'userLname', 'totalCounterpart', 'totalMedical', 'totalPersonalCashAdvance', 'totalGraduationFee', 'totalPayables', 'unpaidCounterpartRecords', 'unpaidMedicalRecords', 'unpaidPersonalCARecords', 'unpaidGraduationFeeRecords'));
        } else
            return redirect()->back()->with('error', 'You are not authorized to access this page.'); {
        }
    }

    public function indexReports()
    {
        if(Auth::user()->role != '0') {
            return redirect()->back()->with('error', 'You are not authorized to access this page.');
        }

        $user = Auth::user();
        $gradeReports = null; // Initialize gradeReports as null
        $userFname = null;
        $userMname = null;
        $userLname = null;
        $userFname = null;
        $userMname = null;
        $userLname = null;
        $disciplinaryRecords = null;
        $totalGPA = null;
        $userJoinedYear = null;
        $userJoinedYearInt = null;
        $userJoinedEffectiveYear = null;

        if ($user->role == 0) {
            $student = $user->student;

            if ($student) {
                // Get the academic records for the student
                $gradeReports = Academic::where('student_id', $student->id)->get();
                $disciplinaryRecords = Disciplinary::where('student_id', $student->id)->get();
                $userFname = $student->first_name;
                $userMname = $student->middle_name;
                $userLname = $student->last_name;
                $userJoined = Carbon::parse($student->joined);
                $userJoinedYear = $userJoined->year;
                $userJoinedYearInt = (int) $userJoinedYear; // Convert to an integer
                $userJoinedEffectiveYear = $userJoinedYearInt + 2;
                $totalGPA = $gradeReports->sum('gpa') / 4 ;
            } else {
                $userName = $user->name;
            }

            return view(
                'pages.student-parent-auth.reports.index',
                compact(
                    'gradeReports',
                    'userFname',
                    'userLname',
                    'userMname',
                    'disciplinaryRecords',
                    'totalGPA',
                    'userJoinedYearInt',
                    'userJoinedEffectiveYear',
                )
            );
        }
    }

    public function indexPayment()
    {
        if (Auth::user()->role == '0') {
            $user = Auth::user();
            $userName = '';

            if ($user->role == 0) {
                // Retrieve the student's name based on the email using the relationship

                $student = $user->student;
                $userName = $student->first_name;
                $userFname = $student->first_name;
                $userMname = $student->middle_name;
                $userLname = $student->last_name;


                // Calculate the total payments for counterpart
                $totalCounterpartPayment = $student->counterpart->sum('amount_paid');

                // Calculate the total payments for medical share
                $totalMedicalPayment = $student->medicalShare->sum('amount_paid');

                // Calculate the total payments for personal cash advance
                $totalPersonalCashAdvancePayment = $student->personalCashAdvance->sum('amount_paid');

                // Calculate the total payments for graduation fee
                $totalGraduationFeePayment = $student->graduationFee->sum('amount_paid');

                $totalPayments = $totalCounterpartPayment + $totalMedicalPayment + $totalPersonalCashAdvancePayment + $totalGraduationFeePayment;



                /** PAID COUNTERPART **/
                $paidCounterpartRecords = $student->counterpart;


                /** PAID MEDICAL RECORDS **/
                $paidMedicalRecords = $student->medicalShare;


                /** PAID MEDICAL RECORDS **/
                $paidPersonalCARecords = $student->personalCashAdvance;


                $paidGraduationFeeRecords = $student->graduationFee;

                if ($student) {
                    $userName = $student->first_name;
                }


            } else {
                $userName = $user->name;
            }

            return view(
                'pages.student-parent-auth.payment.index',
                compact(
                    'userName',
                    'userFname',
                    'userLname',
                    'userMname',
                    'totalCounterpartPayment',
                    'totalMedicalPayment',
                    'totalPersonalCashAdvancePayment',
                    'totalGraduationFeePayment',
                    'totalPayments',
                    'paidCounterpartRecords',
                    'paidMedicalRecords',
                    'paidPersonalCARecords',
                    'paidGraduationFeeRecords',
                )
            );
        } else {
            return redirect()->back()->with('error', 'You are not authorized to access this page.');
        }
    }

    public function indexProfile() {
        $user = Auth::user();

        if($user->role != '0') {
            return redirect()->back()->with('error', 'You are not authorized to access this page.');
        }

        $userData = null;
        $gradeReports = null; // Initialize gradeReports as null
        $userFname = null;
        $userMname = null;
        $userLname = null;
        $disciplinaryRecords = null;
        $totalGPA = null;
        $userJoinedYear = null;
        $userJoinedYearInt = null;
        $userJoinedEffectiveYear = null;

        if($user->role == 0) {
            // Retrieve the student's information based on the email using the relationship
            $student = $user->student;

            if($student) {
                // Create an array with the student's information for profile
                $userData = [
                    'id' => $student->id,
                    'first_name' => $student->first_name,
                    'last_name' => $student->last_name,
                    'middle_name' => $student->middle_name,
                    'email' => $student->email,
                    'phone' => $student->phone,
                    'birthdate' => $student->birthdate,
                    'address' => $student->address,
                    'parent_name' => $student->parent_name,
                    'parent_contact' => $student->parent_contact,
                    'batch_year' => $student->batch_year,
                    'joined' => $student->joined,
                    // Add any other fields you want to retrieve
                ];

                // Get the academic records for the student
                $gradeReports = Academic::where('student_id', $student->id)->get();
                $disciplinaryRecords = Disciplinary::where('student_id', $student->id)->get();
                $userFname = $student->first_name;
                $userMname = $student->middle_name;
                $userLname = $student->last_name;
                $userJoined = Carbon::parse($student->joined);
                $userJoinedYear = $userJoined->year;
                $userJoinedYearInt = (int)$userJoinedYear; // Convert to an integer
                $userJoinedEffectiveYear = $userJoinedYearInt + 2;
                $totalGPA = $gradeReports->sum('gpa') / 4;
            } else {
                $userData = $user->first_name;
            }
        }

        return view('pages.student-parent-auth.profile.index', compact('userData', 'gradeReports', 'userFname', 'userLname', 'userMname', 'disciplinaryRecords', 'totalGPA', 'userJoinedYearInt', 'userJoinedEffectiveYear'));
    }

    public function updateStudentDetails(Request $request)
    {
        $user = auth()->user();
        $student = $user->student;

        // dd($request->all());

        // Update parent details
        $student->parent_name = $request->input('parentName');
        $student->parent_contact = $request->input('parentContact');

        // Save changes
        $student->save();

        // // Update receive OTP setting
        // $user->receive_otp = $request->input('receiveOTP', 1); // Default to 0 if not provided
        // $user->save();

        return redirect()->back()->with('success', 'Student details updated successfully!');
    }

}
