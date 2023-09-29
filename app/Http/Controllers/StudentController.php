<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Student;
use Illuminate\Http\Request;

class StudentController extends Controller
{
    public function index()
    {
        $students = Student::all();
        return view('pages.staff-auth.students.index', compact('students'));
    }

    public function getStudent($id)
    {
        $student = Student::find($id);
        return view('pages.staff-auth.students.index', compact('student'));
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
            'status' => 'required',
            'gpa' => 'nullable|numeric',
        ]);

        $student = new Student([
            'name' => $request->get('name'),
            'batch_year' => $request->get('batch_year'),
            'joined' => $request->get('joined'),
            'status' => $request->get('status'),
            'gpa' => $request->get('gpa'),
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
            'status' => 'required',
            'gpa' => 'nullable|numeric',
        ]);

        $student = Student::find($id);
        $student->name = $request->get('name');
        $student->batch_year = $request->get('batch_year');
        $student->joined = $request->get('joined');
        $student->status = $request->get('status');
        $student->gpa = $request->get('gpa');
        $student->save();

        return redirect('/students')->with('success', 'Student updated!');
    }

    public function destroy($id)
    {
        $student = Student::find($id);
        $student->delete();

        return redirect('/students')->with('success', 'Student deleted!');
    }

    // Academic Reports Controllers

    public function indexAcdRpt()
    {
        $students = Student::all();
        return view('pages.staff-auth.reports.rpt-academic.rpt-academic-page', compact('students'));
    }

    public function indexDcplRpt()
    {
        $students = Student::all();
        return view('pages.staff-auth.reports.rpt-disciplinary.rpt-disciplinary-page', compact('students'));
    }

    public function indexStudent()
    {
        $students = Student::all();
        return view('pages.staff-auth.students.student-info-page', compact('students'));
    }
}
