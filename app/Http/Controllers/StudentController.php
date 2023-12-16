<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Academic;
use App\Models\Disciplinary;
use App\Models\Student;
use App\Models\User;
use App\Services\StoreLogsService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Mail\SendStudentNotification;
use App\Mail\SendStudentAcademicNotification;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use Illuminate\Database\QueryException;
use App\Mail\SendAccountDeletion;
use App\Mail\SendStudentAcademicDeleteNotification;

class StudentController extends Controller
{
    public function index()
    {
        if (Auth::user()->role != '1') {
            return redirect()->back()->with('error', 'You are not authorized to access this page.');
        }

        // $students = Student::all();

        $users = User::where('is_deleted', 0)
            ->where('role', '0')
            ->get();
        $students = Student::whereIn('user_id', $users->pluck('id')->all())->get();

        // dd($students);

        $batchYears = [];

        foreach ($students as $student) {
            if (!in_array($student->batch_year, $batchYears)) {
                $batchYears[] = $student->batch_year;
            }
        }

        return view('pages.staff-auth.students.index', [
            'students' => $students,
            'batchYears' => $batchYears,
        ]);
    }

    public function addStudentPage()
    {
        if (Auth::user()->role == '1') {
            return view('pages.staff-auth.students.student-info-page-add');
        } else {
            return redirect()->back()->with('error', 'You are not authorized to access this page.');
        }
    }

    public function getStudent($id)
    {
        if (Auth::user()->role != '1') {
            return redirect()->back()->with('error', 'You are not authorized to access this page.');
        }

        $student = Student::find($id);
        return view('pages.staff-auth.students.index', compact('student'));
    }

    public function create()
    {
        if (Auth::user()->role == '1') {
            return view('students.create');
        } else {
            return redirect()->back()->with('error', 'You are not authorized to access this page.');
        }
    }

    public function store(Request $request)
    {
        if (Auth::user()->role != '1') {
            return redirect()->back()->with('error', 'You do not have permission to access this page');
        }

        $first_name_orig = $request->input('first_name');
        $last_name = $request->input('last_name');
        $suffix = $request->input('suffix');
        $gender = $request->input('gender');
        $middle_name = $request->input('middle_name');
        $birthdate = $request->input('birthdate');
        $batch_year = $request->input('batch_year');
        $address = $request->input('address');
        $parent_name = $request->input('parent_name');
        $parent_contact = $request->input('parent_contact');
        $joined = $request->input('joined');
        $contact_number = $request->input('contact_number');
        $first_name_with_other_name = $request->input('first_name');

        if ($first_name_orig == null) {
            return redirect()->back()->with('error', 'First Name is required');
        }
        if ($last_name == null) {
            return redirect()->back()->with('error', 'Last Name is required');
        }
        if ($birthdate == null) {
            return redirect()->back()->with('error', 'Birthdate is required');
        }
        if ($batch_year == null) {
            return redirect()->back()->with('error', 'Batch Year is required');
        }
        if ($address == null) {
            return redirect()->back()->with('error', 'Address is required');
        }
        if ($parent_name == null) {
            return redirect()->back()->with('error', 'Parent Name is required');
        }
        if ($parent_contact == null) {
            return redirect()->back()->with('error', 'Parent Contact Number is required');
        }
        if ($joined == null) {
            return redirect()->back()->with('error', 'Date Joined is required');
        }

        $birthdate = $request->input('birthdate');
        $minimumAge = Carbon::now()->subYears(18);

        if ($birthdate != null && Carbon::parse($birthdate)->isAfter($minimumAge)) {
            return redirect()->back()->with('error', 'Birthdate must be at least 18 years old and above');
        }

        if (str_word_count($first_name_orig) > 1) {
            // If more than one word, replace spaces with underscores
            $first_name = strtolower(str_replace(' ', '_', $first_name_orig));
        } else {
            // If only one word, use the name as is
            $first_name = strtolower($first_name_orig);
        }


        $email = strtolower($first_name . '.' . $last_name . '@student.passerellesnumeriques.org');
        // dd($email);

        $checkEmail = User::withTrashed()->where('email', $email)->first();
        // dd($checkEmail);

        if ($checkEmail) {
            $checkEmail->restore();

            $student_account = User::where('email', $email)->first();
            // dd($student_account);
            $student_account->is_deleted = 0;
            $student_account->deleted_at = null;
            $student_account->name = ucfirst($first_name_orig) . ' ' . ucfirst($last_name);
            // $student_account->email = $email;
            $student_account->password = bcrypt('d3f@ultP@$$w0rd');
            $student_account->role = 0;
            $student_account->save();

            // dd($student_account);
            // dd($middle_name);
            $student = Student::where('email', $email)->first();
            // dd($student);
            if ($middle_name == null) {
                $student->middle_name = "N/A";
            } else {
                $student->middle_name = $middle_name;
            }
            $student->last_name = $last_name;
            if ($student->suffix == 'None') {
                $student->suffix = null;
            }
            $student->birthdate = $birthdate;
            $student->email = $email;
            $student->password = bcrypt('d3f@ultP@$$w0rd');
            $student->contact_number = $contact_number;
            $student->address = trim($address);
            $student->gender = $gender;
            $student->parent_name = $parent_name;
            $student->parent_contact = $parent_contact;
            $currentYear = now()->year;
            $endYear = $currentYear + 2;
            if ($batch_year > $endYear) {
                if ($student_account) {
                    $student_account->delete();
                }
                return redirect()->back()->with('error', 'Batch year invalid. Please try again.');
            } else {
                $student->batch_year = $batch_year;
            }
            $student->joined = $joined;
            $student->user_id = $student_account->id;

            $student->save();
        } else {
            $student_account = new User();
            $student_account->name = ucfirst($first_name_orig) . ' ' . ucfirst($last_name);
            $student_account->email = $email;
            $student_account->password = bcrypt('d3f@ultP@$$w0rd');
            $student_account->role = 0;
            $student_account->save();

            $student = new Student();

            $student->first_name = ucfirst($first_name);
            if ($middle_name == null) {
                $student->middle_name = "N/A";
            } else {
                $student->middle_name = $middle_name;
            }
            $student->last_name = $last_name;
            if ($student->suffix == 'None') {
                $student->suffix = null;
            }
            $student->birthdate = $birthdate;
            $student->email = $email;
            $student->password = bcrypt('d3f@ultP@$$w0rd');
            $student->contact_number = $contact_number;
            $student->address = trim($address);
            $student->gender = $gender;
            $student->parent_name = $parent_name;
            $student->parent_contact = $parent_contact;

            $currentYear = now()->year;
            $endYear = $currentYear + 2;
            if ($batch_year > $endYear) {
                if ($student_account) {
                    $student_account->delete();
                }
                return redirect()->back()->with('error', 'Batch year invalid. Please try again.');
            } else {
                $student->batch_year = $batch_year;
            }
            $student->joined = $joined;
            $student->user_id = $student_account->id;

            $student->save();
        }

        // // Try to save the staff, and handle success/failure
        if ($student->save()) {
            //     // Admin saved successfully
            $student_name = $first_name_with_other_name . ' ' . request()->input('last_name');

            $defaultPassUnHashed = 'd3f@ultP@$$w0rd';

            $action = "Added";
            StoreLogsService::storeLogs(auth()->user()->id, $action, "Student", $student->id, null, $batch_year);

            Mail::to($student->email)->send(new SendStudentNotification($student_name, $student->email, $defaultPassUnHashed));
            return redirect()->back()->with('success', 'New student added successfully!');
        } else {
            $student_account->delete();
            return redirect()->back()->with('error', 'Failed to add student. Please try again.')->withInput();
        }
    }

    public function updateStudent(Request $request, $id)
    {
        if (Auth::user()->role == '1') {

            $first_name = $request->input('first_name');
            $last_name = $request->input('last_name');
            $suffix = $request->input('suffix');
            $gender = $request->input('gender');
            $middle_name = $request->input('middle_name');
            $birthdate = $request->input('birthdate');
            $batch_year = $request->input('batch_year');
            $address = $request->input('address');
            $parent_name = $request->input('parent_name');
            $parent_contact = $request->input('parent_contact');
            $joined = $request->input('joined');
            $contact_number = $request->input('contact_number');

            if ($first_name == null) {
                return redirect()->back()->with('error', 'First Name is required');
            }
            if ($last_name == null) {
                return redirect()->back()->with('error', 'Last Name is required');
            }
            if ($birthdate == null) {
                return redirect()->back()->with('error', 'Birthdate is required');
            }
            if ($batch_year == null) {
                return redirect()->back()->with('error', 'Batch Year is required');
            }
            if ($address == null) {
                return redirect()->back()->with('error', 'Address is required');
            }
            if ($parent_name == null) {
                return redirect()->back()->with('error', 'Parent Name is required');
            }
            if ($parent_contact == null) {
                return redirect()->back()->with('error', 'Parent Contact Number is required');
            }
            if ($joined == null) {
                return redirect()->back()->with('error', 'Date Joined is required');
            }

            $birthdate = $request->input('birthdate');
            $minimumAge = Carbon::now()->subYears(18);

            if ($birthdate != null && Carbon::parse($birthdate)->isAfter($minimumAge)) {
                return redirect()->back()->with('error', 'Birthdate must be at least 18 years old and above');
            }

            $student = Student::findOrFail($id);
            $student->first_name = $first_name;
            $student->last_name = $last_name;
            $student->middle_name = $middle_name;
            $student->birthdate = $birthdate;
            $student->address = $address;
            $student->parent_name = $parent_name;
            $student->parent_contact = $parent_contact;
            $student->joined = $joined;
            $student->batch_year = $batch_year;
            $student->contact_number = $contact_number;
            $student->gender = $gender;
            $student->save();

            return back()->with('success', 'Student updated!');
        } else {
            return redirect()->back()->with('error', 'You are not authorized to access this page.');
        }
    }

    private function hasAssociations(Student $student)
    {
        // Check for associations in each related table
        return $student->counterpart()->exists() ||
            $student->medicalShare()->exists() ||
            $student->personalCashAdvance()->exists() ||
            $student->graduationFee()->exists() ||
            $student->academics()->exists() ||
            $student->disciplinary()->exists();
    }

    public function deleteStudent($id)
    {
        try {

            if (Auth::user()->role != '1') {
                return redirect()->back()->with('error', 'You are not authorized to access this page.');
            }

            $student = Student::find($id);

            if (!$student) {
                return back()->with('error', 'Student record not found.');
            } else {

                if ($this->hasAssociations($student)) {
                    return back()->with('error', 'Cannot delete the student. There are records referencing this student.');
                }

                $user = User::find($student->user_id);
                $user->is_deleted = 1;
                $user->deleted_at = now();
                $user->save();

                // Log the action
                $action = "Deleted";
                StoreLogsService::storeLogs(auth()->user()->id, $action, "Student", $id, null, $student->batch_year);

                Mail::to($student->email)->send(new SendAccountDeletion($student->name));

                // Return success message
                return back()->with('success', 'Student record deleted and email sent successfully!');
            }
        } catch (QueryException $e) {
            // Check if the exception is due to foreign key constraint violation
            $errorCode = $e->errorInfo[1];
            if ($errorCode == 1451) {
                // Foreign key constraint violation
                return back()->with('error', 'Cannot delete the student. There are records referencing this student.');
            }

            // Other database error
            return back()->with('error', 'Error deleting student record: ' . $e->getMessage());
        }
    }


    public function indexAcdRpt()
    {
        if (Auth::user()->role == '1') {
            $students = Student::all();
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

            return view('pages.staff-auth.reports.rpt-academic.rpt-academic-page', [
                'students' => $students,
                'batchYears' => $batchYears,
            ]);
        } else {
            return redirect()->back()->with('error', 'You are not authorized to access this page.');
        }
    }


    public function getStudentAcademicReport($id)
    {
        if (Auth::user()->role == '1') {
            $student = Student::find($id);
            return view('pages.staff-auth.students.student-info-page', compact('student'));
        } else {
            return redirect()->back()->with('error', 'You are not authorized to access this page.');

        }
    }

    public function getStudentGradeReport($id)
    {
        if (Auth::user()->role == '1') {
            $student = Student::find($id);

            if (!$student) {
                return back()->with('error', 'Student not found!');
            }

            $academics = Academic::where('student_id', $student->id)->get();

            return view('pages.staff-auth.reports.rpt-academic.rpt-academic-grade-page', compact('student', 'academics'));
        } else {
            return redirect()->back()->with('error', 'You are not authorized to access this page.');
        }
    }

    public function addStudentGradeReport(Request $request, $id)
    {
        if (Auth::user()->role == '1') {
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

    public function updateStudentGradeReport(Request $request, $id)
    {
        if (Auth::user()->role == '1') {
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

    public function destroyStudentGradeReport(Request $request, $id)
    {
        if (Auth::user()->role != '1') {
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

    public function indexStudsList(Request $request)
    {
        if (Auth::user()->role == '1') {
            // Retrieve all students
            $students = Student::whereDoesntHave('disciplinary')->get();

            // Retrieve all disciplinary records along with their associated students
            $studentsWithDisciplinaryRecords = Disciplinary::with('student')->get();

            // Get the selected student's ID from the request (replace 'student_id' with your actual route parameter)
            $selectedStudentId = $request->route('student_id');

            // Filter records for the selected student
            $selectedStudentRecords = $studentsWithDisciplinaryRecords->where('student_id', $selectedStudentId);

            return view('pages.staff-auth.reports.rpt-disciplinary.rpt-disciplinary-page', compact('students', 'selectedStudentId', 'selectedStudentRecords', 'studentsWithDisciplinaryRecords'));
        } else {
            return redirect()->back()->with('error', 'You are not authorized to access this page.');
        }
    }

    // Student Information Controllers

    public function indexStudent()
    {
        if (Auth::user()->role == '1') {
            $students = Student::all();
            return view('pages.staff-auth.students.student-info-page', compact('students'));
        } else {
            return redirect()->back()->with('error', 'You are not authorized to access this page.');
        }

    }

    public function getStudentInfo($id)
    {
        if (Auth::user()->role == '1') {
            $student = Student::find($id);
            return view('pages.staff-auth.students.student-info-page', compact('student'));
        } else {
            return redirect()->back()->with('error', 'You are not authorized to access this page.');
        }
    }

    public function updateReceiveOTP(Request $request)
    {
        $user = auth()->user();

        // Update receive OTP setting
        $user->receive_otp = $request->input('receiveOTP', 1); // Default to 0 if not provided
        $user->save();

        return redirect()->back()->with('success', 'Settings updated!');
    }

}
