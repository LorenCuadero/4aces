<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\Student;

class StudentParentController extends Controller
{
    public function indexStudent()
    {
        $user = Auth::user();
        $userName = '';
    
        if ($user->role == 0) {
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
}