<?php

namespace App\Http\Controllers;

use App\Models\Academic;
use Illuminate\Http\Request;
use App\Models\Student;
use Illuminate\Support\Facades\Auth;
use App\Services\StoreLogsService;
use Illuminate\Support\Facades\Mail;
use App\Mail\SendStudentAcademicNotification;
use App\Models\User;
use App\Mail\SendStudentAcademicDeleteNotification;

class AcademicController extends Controller {
    /**
     * Display a listing of the resource.
     */

    public function index() {
        if(Auth::user()->role != '1') {
            return redirect()->back()->with('error', 'You do not have permission to access this page');
        }
        $academics = Academic::all();
        return view('academics.index', compact('academics'));
    }

    public function indexAcademicReports()
    {
        if (Auth::user()->role == '2') {
            $users = User::where('is_deleted', false)->get();
            $studentIds = $users->pluck('id');
            $students = Student::whereIn('user_id', $studentIds)->get();
            $batchYears = [];

            foreach ($students as $student) {
                if (!in_array($student->batch_year, $batchYears)) {
                    $batchYears[] = $student->batch_year;
                }

                // Retrieve all academic records for the student
                $academics = Academic::where('student_id', $student->id)->get();

                $first_sem_fisrt_year_gpa = 0;
                $second_sem_first_year_gpa = 0;
                $first_sem_second_year_gpa = 0;
                $second_sem_second_year_gpa = 0;
                $first_sem_third_year_gpa = 0;
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

                if ($student) {
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
                    $totalGPA = $gradeReports->sum('gpa') / 4;
                } else {
                    $userData = $student->first_name;
                }

                foreach ($academics as $academic) {
                    switch ($academic->year_and_sem) {
                        case 0:
                            $first_sem_fisrt_year_gpa += ($academic->midterm_grade + $academic->final_grade) / 2;
                            break;
                        case 1:
                            $second_sem_first_year_gpa += ($academic->midterm_grade + $academic->final_grade) / 2;
                            break;
                        case 2:
                            $first_sem_second_year_gpa += ($academic->midterm_grade + $academic->final_grade) / 2;
                            break;
                        case 3:
                            $second_sem_second_year_gpa += ($academic->midterm_grade + $academic->final_grade) / 2;
                            break;
                        case 4:
                            $first_sem_third_year_gpa += ($academic->midterm_grade + $academic->final_grade) / 2;
                            break;
                    }
                }

                $total_gpa_per_semester = $first_sem_fisrt_year_gpa + $second_sem_first_year_gpa + $first_sem_second_year_gpa + $second_sem_second_year_gpa + $first_sem_third_year_gpa;

                // Assign the total GPA to the student model
                $student->gwa = round($total_gpa_per_semester, 2);
            }

            return view('pages.admin-auth.academic-reports.index', [
                'students' => $students,
                'batchYears' => $batchYears,
            ], compact('totalGPA'));
        } else {
            return redirect()->back()->with('error', 'You are not authorized to access this page.');
        }
    }

    public function getStudentGradeReport($id)
    {
        if (Auth::user()->role == '2') {
            $student = Student::find($id);

            if (!$student) {
                return back()->with('error', 'Student not found!');
            }

            $academics = Academic::where('student_id', $student->id)->get();

            return view('pages.admin-auth.academic-reports.grade-page', compact('student', 'academics'));
        } else {
            return redirect()->back()->with('error', 'You are not authorized to access this page.');
        }
    }

    public function addStudentGradeReport(Request $request, $id)
    {

        if (Auth::user()->role == '2') {
            if ($request->input('course_code') == null) {
                return back()->with('error', 'Please enter a course code');
            } elseif ($request->input('midterm_grade') > 4 || $request->input('midterm_grade') < 0) {
                return back()->with('error', 'Please enter a valid midterm grade');
            } elseif ($request->input('final_grade') > 4 || $request->input('final_grade') < 0) {
                return back()->with('error', 'Please enter a valid final grade');
            } elseif ($request->input('year_and_sem') == null && $request->input('midterm_grade') != null) {
                return back()->with('error', 'Please select a year and semester');
            } elseif ($request->input('year_and_sem') == null && $request->input('final_grade') != null) {
                return back()->with('error', 'Please select a year and semester');
            } elseif ($request->input('year_and_sem') == null && $request->input('midterm_grade') != null && $request->input('final_grade') != null) {
                return back()->with('error', 'Please select a year and semester');
            }

            // Validate the input data
            $validatedData = $request->validate([
                'course_code' => 'required|string',
                'student_id' => 'required|exists:students,id',
                'year_and_sem' => 'nullable|numeric|between:0,4',
                'midterm_grade' => 'nullable|numeric|between:0,5',  // Updated validation for midterm_grade
                'final_grade' => 'nullable|numeric|between:0,5',    // Updated validation for final_grade
                'gpa' => 'nullable|numeric|between:0,5',
            ]);

            $yearAndSem = $validatedData['year_and_sem'] ?? null;

            $validatedData['gpa'] = $validatedData['midterm_grade'] + $validatedData['final_grade'] / 2;

            $academic = Academic::where('student_id', $validatedData['student_id'])
                ->where('course_code', $validatedData['course_code'])
                ->first();

            if ($academic) {
                return redirect()->back()->with('error', 'An academic record for this course already exists.');
            }

            $student = Student::find($id);

            // Check if the student exists
            if (!$student) {
                return redirect()->back()->with('error', 'Student not found.');
            }

            // Access the student's email
            $student_email = $student->email;
            $student_name = $student->first_name . '' . $student->last_name;

            $action = "Added";
            StoreLogsService::storeLogs(auth()->user()->id, $action, "Academic", $validatedData['student_id'], null, $student->batch_year);

            Mail::to($student_email)->send(new SendStudentAcademicNotification($student_name, $validatedData['course_code'], $yearAndSem, $validatedData['midterm_grade'], $validatedData['final_grade']));
            Academic::create($validatedData);

            return redirect()->back()->with('success', 'Academic record added and email sent successfully!');
        } else {
            return redirect()->back()->with('error', 'You are not authorized to access this page.');
        }
    }

    public function destroyStudentGradeReport(Request $request, $id)
    {
        if (Auth::user()->role != '2') {
            return redirect()->back()->with('error', 'You do not have permission to access this page');
        }

        $academicId = $request->input('academic_id');

        // dd($id);

        $academic = Academic::find($academicId);
        if (!$academic) {
            return back()->with('error', 'Academic record not found.');
        }

        $student = Student::find($id);
        if (!$student) {
            return back()->with('error', 'Student not found.');
        }

        // Access the student's email
        $student_email = $student->email;
        $student_name = $student->first_name . '' . $student->last_name;

        $action = "Deleted";
        StoreLogsService::storeLogs(auth()->user()->id, $action, "Academic", $request->input('student_id'), null, $student->batch_year);

        Mail::to($student_email)->send(new SendStudentAcademicDeleteNotification($student_name, $academic->course_code, $academic->year_and_sem, $academic->midterm_grade, $academic->final_grade));

        $academic->delete();

        return redirect()->back()->with('success', 'Academic record deleted successfully.');
    }
    public function updateStudentGradeReport(Request $request, $id)
    {
        if (Auth::user()->role == '2') {
            $request->validate([
                'course_code' => 'required|string',
                'year_and_sem' => 'nullable',
                'midterm' => 'nullable|numeric',
                'final' => 'nullable|numeric',
            ]);

            if ($request->input('course_code') == null) {
                return back()->with('error', 'Please enter a course code');
            } elseif ($request->input('year_and_sem') == null && $request->input('midterm') != null) {
                return back()->with('error', 'Please select a year and semester');
            } elseif ($request->input('midterm') > 4 || $request->input('midterm') < 0) {
                return back()->with('error', 'Please enter a valid midterm grade');
            } elseif ($request->input('final') > 4 || $request->input('final') < 0) {
                return back()->with('error', 'Please enter a valid final grade');
            } elseif ($request->input('year_and_sem') == null && $request->input('final_grade') != null) {
                return back()->with('error', 'Please select a year and semester');
            } elseif ($request->input('year_and_sem') == null && $request->input('midterm_grade') != null && $request->input('final_grade') != null) {
                return back()->with('error', 'Please select a year and semester');
            }

            $academicId = $request->input('academic_id');

            $academic = Academic::find($academicId);

            if (!$academic) {
                return back()->with('error', 'Academic record not found.');
            }

            $academic->course_code = $request->input('course_code');
            $academic->year_and_sem = $request->input('year_and_sem');
            $academic->midterm_grade = $request->input('midterm');
            $academic->final_grade = $request->input('final');
            $academic->gpa = $request->input('midterm') + $request->input('final') / 2;

            $academic->save();

            $student = Student::find($id);

            // Check if the student exists
            if (!$student) {
                return redirect()->back()->with('error', 'Student not found.');
            }

            // Access the student's email
            $student_email = $student->email;
            $student_name = $student->first_name . '' . $student->last_name;

            $action = "Updated";
            StoreLogsService::storeLogs(auth()->user()->id, $action, "Academic", $request->input('student_id'), null, $student->batch_year);

            Mail::to($student_email)->send(new SendStudentAcademicNotification($student_name, $academic->course_code, $academic->year_and_sem, $academic->midterm_grade, $academic->final_grade));

            return redirect()->back()->with('success', 'Academic record updated successfully.');
        } else {
            return redirect()->back()->with('error', 'You are not authorized to access this page.');
        }
    }




    public function getStudentAcademicReport($id) {
        if(Auth::user()->role != '1') {
            return redirect()->back()->with('error', 'You do not have permission to access this page');
        }
        $student = Student::find($id);
        $academics = Academic::all();

        if(!$student) {
            return back()->with('error', 'Student not found!');
        }

        if($academics->isEmpty()) {
            return back()->with('error', 'Student not found!');
        }

        return view('pages.staff-auth.students.student-info-page', compact('student', 'academics'));
    }

    /**
     * Show the form for creating a new resource.
     */

    public function create() {
        if(Auth::user()->role != '1') {
            return redirect()->back()->with('error', 'You do not have permission to access this page');
        }
        $students = Student::all();
        return view('academics.create', compact('students'));
    }

    public function addStudentAcademicReport(Request $request, $id) {
        if(Auth::user()->role != '1') {
            return redirect()->back()->with('error', 'You do not have permission to access this page');
        }
        $validatedData = $request->validate([
            'course_code' => 'required|string',
            'first_sem_1st_year' => 'required|numeric|between:0,4',
            'second_sem_1st_year' => 'required|numeric|between:0,4',
            'first_sem_2nd_year' => 'required|numeric|between:0,4',
            'second_sem_2nd_year' => 'required|numeric|between:0,4',
            'gpa' => 'required|numeric|between:0,4',
            'student_id' => 'required|exists:students,id',
        ]);

        Academic::create($validatedData);

        return redirect()->back()->with('success', 'Academic record added successfully!');
    }

    public function createAcademic($studentId) {
        if(Auth::user()->role != '1') {
            return redirect()->back()->with('error', 'You do not have permission to access this page');
        }
        $student = Student::find($studentId);

        return view('academics.create', compact('student'));
    }

    /**
     * Display the specified resource.
     */

    public function showAcademics($studentId) {
        if(Auth::user()->role != '1') {
            return redirect()->back()->with('error', 'You do not have permission to access this page');
        }
        $student = Student::find($studentId);
        $academics = $student->academics;

        return view('academics.index', compact('academics'));
    }

    public function show(Academic $academic) {
        if(Auth::user()->role != '1') {
            return redirect()->back()->with('error', 'You do not have permission to access this page');
        }
        return view('academics.show', compact('academic'));
    }

    public function edit(Academic $academic) {
        if(Auth::user()->role != '1') {
            return redirect()->back()->with('error', 'You do not have permission to access this page');
        }

        $students = Student::all();
        return view('academics.edit', compact('academic', 'students'));
    }

    public function updateAcademic(Request $request, $id) {
        if(Auth::user()->role != '1') {
            return redirect()->back()->with('error', 'You do not have permission to access this page');
        }

        $validatedData = $request->validate([
            'course_code' => 'required|string',
            'first_semester_1st_year' => 'nullable|numeric',
            'second_semester_1st_year' => 'nullable|numeric',
            'first_semester_2nd_year' => 'nullable|numeric',
            'second_semester_2nd_year' => 'nullable|numeric',
            'gpa' => 'nullable|numeric',
            'student_id' => 'required|exists:students,id'
        ]);

        $academic = Academic::find($id);
        $academic->update($validatedData);

        return redirect()->back()->with('success', 'Academic record updated successfully!');
    }

    public function destroyAcademic($id) {
        if(Auth::user()->role != '1') {
            return redirect()->back()->with('error', 'You do not have permission to access this page');
        }

        $academic = Academic::find($id);
        $academic->delete();

        return redirect()->back()->with('success', 'Academic record deleted successfully!');
    }
}
