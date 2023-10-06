<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class StudentParentController extends Controller
{
    public function indexStudent()
    {
        $user = auth()->user();
    
        if ($user->role == 0) {
            $student = $user->studentName; // Access the related student model
            if ($student) {
                $userName = $student->name; // Access the 'name' attribute of the student
            } else {
                // Handle the case where no associated student is found
                $userName = 'No Associated Student';
            }
        } else {
            $userName = $user->name; // Use the user's name for other roles
        }
    
        return view('pages.student-parent-auth.payable.index', compact('userName'));
    }
    
    
}
