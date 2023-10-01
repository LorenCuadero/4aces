<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Student;
use App\Models\Academic;
use App\Models\Disciplinary;
use Illuminate\Http\Request;

class StudentController extends Controller {
    public function index() {
        $students = Student::all();

        $batchYears = [];

        foreach ( $students as $student ) {
            if ( !in_array( $student->batch_year, $batchYears ) ) {
                $batchYears[] = $student->batch_year;
            }
        }

        return view( 'pages.staff-auth.students.index', [
            'students' => $students,
            'batchYears' => $batchYears,
        ] );
    }

    public function getStudent( $id ) {
        $student = Student::find( $id );
        return view( 'pages.staff-auth.students.index', compact( 'student' ) );
    }

    public function create() {
        return view( 'students.create' );
    }

    public function store( Request $request ) {
        $request->validate( [
            'name' => 'required',
            'batch_year' => 'required',
            'joined' => 'required',
            'status' => 'required',
            'gpa' => 'nullable|numeric',
        ] );

        $student = new Student( [
            'name' => $request->get( 'name' ),
            'batch_year' => $request->get( 'batch_year' ),
            'joined' => $request->get( 'joined' ),
            'status' => $request->get( 'status' ),
            'gpa' => $request->get( 'gpa' ),
        ] );

        $student->save();

        return redirect( '/students' )->with( 'success', 'Student added!' );
    }

    public function update( Request $request, $id ) {
        $request->validate( [
            'name' => 'required',
            'batch_year' => 'required',
            'joined' => 'required',
            'status' => 'required',
            'gpa' => 'nullable|numeric',
        ] );

        $student = Student::find( $id );
        $student->name = $request->get( 'name' );
        $student->batch_year = $request->get( 'batch_year' );
        $student->joined = $request->get( 'joined' );
        $student->status = $request->get( 'status' );
        $student->gpa = $request->get( 'gpa' );
        $student->save();

        return redirect( '/students' )->with( 'success', 'Student updated!' );
    }

    public function destroy( $id ) {
        $student = Student::find( $id );
        $student->delete();

        return redirect( '/students' )->with( 'success', 'Student deleted!' );
    }

    // Academic Reports Controllers

    public function indexAcdRpt() {
        $students = Student::all();
        $batchYears = [];

        foreach ( $students as $student ) {
            if ( !in_array( $student->batch_year, $batchYears ) ) {
                $batchYears[] = $student->batch_year;
            }

            // Retrieve all academic records for the student
            $academics = Academic::where( 'student_id', $student->id )->get();

            // Calculate the total GPA for the student
            $totalGPA = $academics->sum( 'gpa' );

            // Assign the total GPA to the student model
            $student->totalGPA = $totalGPA;
        }

        return view( 'pages.staff-auth.reports.rpt-academic.rpt-academic-page', [
            'students' => $students,
            'batchYears' => $batchYears,
        ] );
    }

    public function getStudentAcademicReport( $id ) {
        $student = Student::find( $id );
        return view( 'pages.staff-auth.students.student-info-page', compact( 'student' ) );
    }

    public function getStudentGradeReport( $id ) {
        $student = Student::find( $id );

        if ( !$student ) {
            return back()->with( 'error', 'Student not found!' );
        }

        $academics = Academic::where( 'student_id', $student->id )->get();

        return view( 'pages.staff-auth.reports.rpt-academic.rpt-academic-grade-page', compact( 'student', 'academics' ) );
    }

    public function addStudentGradeReport( Request $request, $id ) {
        $validatedData = $request->validate( [
            'course_code' => 'required|string',
            'first_sem_1st_year' => 'nullable|numeric|between:0,4',
            'second_sem_1st_year' => 'nullable|numeric|between:0,4',
            'first_sem_2nd_year' => 'nullable|numeric|between:0,4',
            'second_sem_2nd_year' => 'nullable|numeric|between:0,4',
            'gpa' => 'nullable|numeric|between:0,4',
            'student_id' => 'required|exists:students,id',
        ] );

        // Calculate the GPA as the sum of the two semesters in each year
        $gpa = ( $validatedData[ 'first_sem_1st_year' ] + $validatedData[ 'second_sem_1st_year' ] + $validatedData[ 'first_sem_2nd_year' ] + $validatedData[ 'second_sem_2nd_year' ] ) / 4;

        // Find the academic record for the student and course code
        $academic = Academic::where( 'student_id', $validatedData[ 'student_id' ] )
        ->where( 'course_code', $validatedData[ 'course_code' ] )
        ->first();

        if ( $academic ) {
            // Academic record already exists, display an error message
            return redirect()->back()->with( 'error', 'An academic record for this course already exists.' );
        } else {
            // Create a new academic record with the calculated GPA
            Academic::create( array_merge( $validatedData, [ 'gpa' => $gpa ] ) );
            return redirect()->back()->with( 'success', 'Academic record added successfully!' );
        }
    }

    public function updateStudentGradeReport( Request $request, $studentId ) {
        // Validate the form data
        $validatedData = $request->validate( [
            'course_code' => 'required|string',
            'first_sem_1st_year' => 'nullable|numeric|between:0,4',
            'second_sem_1st_year' => 'nullable|numeric|between:0,4',
            'first_sem_2nd_year' => 'nullable|numeric|between:0,4',
            'second_sem_2nd_year' => 'nullable|numeric|between:0,4',
            'gpa' => 'nullable|numeric|between:0,4',
        ] );

        // Find the academic record by student ID and course code
        $academic = Academic::where( 'student_id', $studentId )
        ->where( 'course_code', $validatedData[ 'course_code' ] )
        ->first();

        if ( !$academic ) {
            return back()->with( 'error', 'Academic record not found.' );
        }

        // Update the academic record with the validated data
        $academic->update( $validatedData );

        return redirect()->back()->with( 'success', 'Academic record updated successfully.' );
    }

    // Disciplinary Reports Controllers

    public function indexStudsList( Request $request ) {
        // Retrieve all students
        $students = Student::all();

        // Retrieve all disciplinary records along with their associated students
        $studentsWithDisciplinaryRecords = Disciplinary::with( 'student' )->get();

        // Get the selected student's ID from the request (replace 'student_id' with your actual route parameter)
        $selectedStudentId = $request->route('student_id');
    
        // Filter records for the selected student
        $selectedStudentRecords = $studentsWithDisciplinaryRecords->where('student_id', $selectedStudentId);
    
        return view('pages.staff-auth.reports.rpt-disciplinary.rpt-disciplinary-page', compact('students', 'selectedStudentRecords', 'studentsWithDisciplinaryRecords'));
    }
    
    
    

    // Student Information Controllers

    public function indexStudent() {
        $students = Student::all();
        return view( 'pages.staff-auth.students.student-info-page', compact( 'students' ) );
    }

    public function getStudentInfo( $id ) {
        $student = Student::find( $id );
        return view( 'pages.staff-auth.students.student-info-page', compact( 'student' ) );
    }

    public function updateStudent( Request $request, $id ) {
        $request->validate( [
            'first_name' => 'required',
            'last_name' => 'required',
            'middle_name' => 'required',
            'email' => 'required|email',
            'phone' => 'required',
            'birthdate' => 'required|date',
            'address' => 'required',
            'parent_name' => 'required',
            'parent_contact' => 'required',
            'payable_status' => 'required|in:paid, unpaid',
            'account_status' => 'required|in:active, closed',
        ] );

        $student = Student::find( $id );
        $student->first_name = $request->get( 'first_name' );
        $student->last_name = $request->get( 'last_name' );
        $student->middle_name = $request->get( 'middle_name' );
        $student->email = $request->get( 'email' );
        $student->phone = $request->get( 'phone' );
        $student->birthdate = $request->get( 'birthdate' );
        $student->address = $request->get( 'address' );
        $student->parent_name = $request->get( 'parent_name' );
        $student->parent_contact = $request->get( 'parent_contact' );
        $student->payable_status = $request->get( 'payable_status' );
        $student->account_status = $request->get( 'account_status' );
        $student->save();

        return back()->with( 'success', 'Student updated!' );
    }

}
