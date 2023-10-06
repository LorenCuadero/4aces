<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class StudentParentController extends Controller
{
    public function indexStudent()
    {
        return view('pages.student-parent-auth.payable.index');
    }
}
