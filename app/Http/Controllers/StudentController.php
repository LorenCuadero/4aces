<?php

namespace App\Http\Controllers;

use App\Models\Student;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class StudentController extends Controller
{
    public function index()
    {
        $students = Student::orderBy('created_at', 'desc')->paginate(1);
        return view('pages.staff-auth.students.index', compact('students'));
    }

    public function create()
    {
        return view('students.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'batch_year' => 'required',
            'joined' => 'required',
            'status' => 'required'
        ]);

        $student = new Student([
            'name' => $request->get('name'),
            'batch_year' => $request->get('batch_year'),
            'joined' => $request->get('joined'),
            'status' => $request->get('status')
        ]);
        
        $student->save();

        return redirect('/students')->with('success', 'Student added!');
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required',
            'batch_year' => 'required',
            'joined' => 'required',
            'status' => 'required'
        ]);

        $student = Student::find($id);
        $student->name = $request->get('name');
        $student->batch_year = $request->get('batch_year');
        $student->joined = $request->get('joined');
        $student->status = $request->get('status');
        $student->save();

        return redirect('/students')->with('success', 'Student updated!');
    }

    // public function destroy($id)
    // {
    //     $student = Student::find($id);
    //     $student->delete();

    //     return redirect('/students')->with('success', 'Student deleted!');
    // }
}