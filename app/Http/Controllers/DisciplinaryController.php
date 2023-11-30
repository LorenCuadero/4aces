<?php

namespace App\Http\Controllers;

use App\Models\Disciplinary;
use App\Services\StoreLogsService;
use Illuminate\Http\Request;
use App\Models\Student;
use Illuminate\Support\Facades\Mail;
use App\Mail\SendDisciplinaryNotification;

class DisciplinaryController extends Controller
{
    public function index()
    {
        $studentsWithDisciplinaryRecords = Student::has('disciplinary')->get();
        return view('pages.staff-auth.reports.rpt-disciplinary.rpt-disciplinary-page', compact('studentsWithDisciplinaryRecords'));
    }

    // public function showDisciplinaryRecordsForStudent($id) {
    //     $students = Student::find($id);
    //     return view('modals.staff.mdl-student-dcpl-rpt-add', compact('students'));
    // }


    public function create()
    {
        $students = Student::all();
        return view('disciplinary.create', compact('students'));
    }

    public function store(Request $request)
    {

        if ($request->input('student_id_dcpl') == null) {
            return redirect()->back()->with('error', 'Please select a student');
        } elseif ($request->input('verbal_warning_date') == null && $request->input('verbal_warning_description') != null) {
            return redirect()->back()->with('error', 'Please select a verbal warning date');
        } elseif ($request->input('written_warning_date') == null && $request->input('written_warning_description') != null) {
            return redirect()->back()->with('error', 'Please select a written warning date');
        } elseif ($request->input('provisionary_date') == null && $request->input('provisionary_description') != null) {
            return redirect()->back()->with('error', 'Please select a probationary warning date');
        } elseif ($request->input('verbal_warning_date') != null && $request->input('verbal_warning_description') == null) {
            return redirect()->back()->with('error', 'Please enter a verbal warning description');
        } elseif ($request->input('written_warning_date') != null && $request->input('written_warning_description') == null) {
            return redirect()->back()->with('error', 'Please enter a written warning description');
        } elseif ($request->input('provisionary_date') != null && $request->input('provisionary_description') == null) {
            return redirect()->back()->with('error', 'Please enter a probationary warning description');
        }

        $data = $request->validate([
            'verbal_warning_description' => 'nullable|string',
            'verbal_warning_date' => 'nullable|date',
            'written_warning_description' => 'nullable|string',
            'written_warning_date' => 'nullable|date',
            'provisionary_description' => 'nullable|string',
            'provisionary_date' => 'nullable|date',
            'student_id_dcpl' => 'required|exists:students,id',
        ]);

        $disciplinary = new Disciplinary($data);

        // Associate the disciplinary record with the student
        $student = Student::find($data['student_id_dcpl']);
        $student->disciplinary()->save($disciplinary);

        $action = 'Added';
        StoreLogsService::storeLogs(auth()->user()->id, $action, 'Disciplinary', $data['student_id_dcpl'], null, $student->batch_year);

        Mail::to($student->email)->send(new SendDisciplinaryNotification($student->first_name, $data['verbal_warning_description'], $data['written_warning_description'], $data['provisionary_description'], $data['verbal_warning_date'], $data['written_warning_date'], $data['provisionary_date']));

        return redirect()->route('rpt.dcpl.index')->with('success', 'Disciplinary record created.');
    }


    public function show(Disciplinary $disciplinary)
    {
        return view('disciplinary.show', compact('disciplinary'));
    }

    public function edit(Disciplinary $disciplinary)
    {
        $students = Student::all();
        return view('disciplinary.edit', compact('disciplinary', 'students'));
    }

    public function update(Request $request, $id)
    {
        $existingRecord = Disciplinary::findOrFail($id);

        if ($request->input('verbal_warning_date') == null && $request->input('verbal_warning_description') != null) {
            return redirect()->back()->with('error', 'Please select a verbal warning date');
        } elseif ($request->input('written_warning_date') == null && $request->input('written_warning_description') != null) {
            return redirect()->back()->with('error', 'Please select a written warning date');
        } elseif ($request->input('provisionary_date') == null && $request->input('provisionary_description') != null) {
            return redirect()->back()->with('error', 'Please select a probationary warning date');
        } elseif ($request->input('verbal_warning_date') != null && $request->input('verbal_warning_description') == null) {
            return redirect()->back()->with('error', 'Please enter a verbal warning description');
        } elseif ($request->input('written_warning_date') != null && $request->input('written_warning_description') == null) {
            return redirect()->back()->with('error', 'Please enter a written warning description');
        } elseif ($request->input('provisionary_date') != null && $request->input('provisionary_description') == null) {
            return redirect()->back()->with('error', 'Please enter a probationary warning description');
        }

        // Validate the request data
        $data = $request->validate([
            'verbal_warning_description' => 'nullable|string',
            'verbal_warning_date' => 'nullable|date',
            'written_warning_description' => 'nullable|string',
            'written_warning_date' => 'nullable|date',
            'provisionary_description' => 'nullable|string',
            'provisionary_date' => 'nullable|date',
            'student_id' => 'required|exists:students,id',
        ]);

        $existingRecord->fill($data);
        $existingRecord->save();

        $student = Student::find($data['student_id']);

        $action = 'Updated';
        StoreLogsService::storeLogs(auth()->user()->id, $action, 'Disciplinary', $data['student_id'], null, $student->batch_year);

        Mail::to($student->email)->send(new SendDisciplinaryNotification($student->first_name, $data['verbal_warning_description'], $data['written_warning_description'], $data['provisionary_description'], $data['verbal_warning_date'], $data['written_warning_date'], $data['provisionary_date']));

        return redirect()->route('rpt.dcpl.index')->with('success', 'Disciplinary record updated.');
    }
}
