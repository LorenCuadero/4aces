<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Academic;
use App\Models\Disciplinary;
use App\Models\Student;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;

class StudentParentController extends Controller {
    public function indexStudent() {
        $user = Auth::user();
        $userName = '';

        if ( $user->role == 0 ) {
            // Retrieve the student's name based on the email using the relationship
            $student = $user->student;

            if ($student) {
                $userName = $student->first_name;
            }
        } else {
            $userName = $user->name;
        }

        return view('pages.student-parent-auth.payable.index', compact('userName'));
    }

    public function indexReports()
    {
        $user = Auth::user();
        $gradeReports = null; // Initialize gradeReports as null
        $userFname = null;
        $userMname = null;
        $userLname = null;

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
                $gradeFirstSemFirstYear = $student->first_sem_1st_year;
                $gradeFirstSemSecondYear = $student->first_sem_2nd_year;
                $gradeSecondSemFirstYear = $student->second_sem_1st_year;
                $gradeSecondSemSecondYear = $student->second_sem_2nd_year;
                $totalGPA = $gradeReports->sum('gpa');
            } else {
                $userName = $user->name;
            }

            return view('pages.student-parent-auth.reports.index', compact(
                'gradeReports', 
                'userFname', 
                'userLname', 
                'userMname', 
                'gradeFirstSemFirstYear',
                'gradeFirstSemSecondYear',
                'gradeSecondSemFirstYear',
                'gradeSecondSemSecondYear',
                'disciplinaryRecords',
                'totalGPA',
                'userJoinedYearInt',
                'userJoinedEffectiveYear'
            ));
        }
    }

    public function indexPayment()
    {
        $user = Auth::user();
        $userName = '';

        if ($user->role == 0) {
            // Retrieve the student's name based on the email using the relationship
            $student = $user->student;

            if ( $student ) {
                $userName = $student->first_name;
            }
        } else {
            $userName = $user->name;
        }

        return view( 'pages.student-parent-auth.payment.index', compact( 'userName' ) );
    }

    public function indexProfile()
    {
        $user = Auth::user();
        $userData = null;
    
        if ($user->role == 0) {
            // Retrieve the student's information based on the email using the relationship
            $student = $user->student;
    
            if ($student) {
                // Create an array with the student's information
                $userData = [
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
            }
        } else {
            $userData = $user->first_name;
        }
    
        return view('pages.student-parent-auth.profile.index', compact('userData'));
    }
    

}
