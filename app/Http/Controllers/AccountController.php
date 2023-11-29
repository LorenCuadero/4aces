<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Admin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Mail\SendAdminNotification;
use Illuminate\Support\Facades\Validator;

class AccountController extends Controller
{
    public function indexAdminAccounts()
    {
        $users = User::where('role', 2)->get();
        return view('pages.admin-auth.accounts.admin-account', compact('users'));
    }

    public function indexStudentsAccounts()
    {
        $users = User::where('role', 0)->get();
        return view('pages.admin-auth.accounts.student-account', compact('users'));
    }

    public function indexStaffAccounts()
    {
        $users = User::where('role', 1)->get();
        return view('pages.admin-auth.accounts.staff-account', compact('users'));
    }

    public function createAdminAccount()
    {
        return view('pages.admin-auth.accounts.admin.index');
    }

    public function getAdminAccount($id)
    {
        $user = User::find($id);
        return view('pages.admin-auth.accounts.edit-admin-account', compact('user'));
    }

    public function getStudentAccount($id)
    {
        $user = User::find($id);
        return view('pages.admin-auth.accounts.edit-student-account', compact('user'));
    }

    public function getStaffAccount($id)
    {
        $user = User::find($id);
        return view('pages.admin-auth.accounts.edit-staff-account', compact('user'));
    }

    public function storeAdminAccount(Request $request)
    {
        // Validation rules
        $rules = [
            'first_name' => 'required|string',
            'middle_name' => 'nullable|string',
            'last_name' => 'required|string',
            'department' => 'nullable|string',
            'gender' => 'nullable|string',
            'address' => 'nullable|string',
            'civil_status' => 'nullable|string',
            'contact_number' => 'nullable|string',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:6',
        ];

        // Custom validation messages
        $messages = [
            'password.min' => 'The password must be at least 6 characters.',
        ];

        // Validate the request
        $validator = Validator::make($request->all(), $rules, $messages);

        // If validation fails, redirect back with errors
        if ($validator->fails()) {
            return redirect()->back()->with('error', 'Failed to save account. Please try again.')->withInput();
        }

        // Validation passed, proceed with creating the admin account


        $admin_account = new User();
        $admin_account->name = request()->input('first_name') . ' ' . request()->input('last_name');
        $admin_account->email = request()->input('email');
        $admin_account->password = bcrypt(request()->input('password'));
        $admin_account->role = 2;
        $admin_account->email_verified_at = now();

        // Try to save the user, and handle success/failure
        if ($admin_account->save()) {
            // User saved successfully

            $admin = new Admin();
            $admin->first_name = request()->input('first_name');
            $admin->middle_name = request()->input('middle_name');
            $admin->last_name = request()->input('last_name');
            $admin->email = request()->input('email');
            $admin->password = bcrypt(request()->input('password'));
            $admin->contact_number = request()->input('contact_number');
            $admin->department = request()->input('department');
            $admin->address = request()->input('address');
            $admin->gender = request()->input('gender');
            $admin->civil_status = request()->input('civil_status');

            // Try to save the admin, and handle success/failure
            if ($admin->save()) {
                // Admin saved successfully
                $admin_name = request()->input('first_name') . ' ' . request()->input('last_name');

                Mail::to($admin->email)->send(new SendAdminNotification($admin_name, $admin->email, $admin->password));

                return redirect()->back()->with('success', 'New admin added successfully!');
            } else {
                $admin_account->delete();
                return redirect()->back()->with('error', 'Failed to save admin. Please try again.')->withInput();
            }
        } else {
            return redirect()->back()->with('error', 'Failed to save user. Please try again.')->withInput();
        }
    }

    public function storeStudentAccount(Request $request)
    {

        $validatedData = $request->validate([
            'student_name' => 'required',
            'student_email' => 'required|email|unique:users,email',
            'student_password' => 'required|string|min:8|confirmed',
        ]);

        $student_account = new User($validatedData);
        $student_account->password = bcrypt($validatedData['student_password']);
        $student_account->save();

        return redirect()->back()->with('success', 'New student added successfully!');
    }

    public function storeStaffAccount(Request $request)
    {
        $validatedData = $request->validate([
            'staff_name' => 'required',
            'staff_email' => 'required|email|unique:users,email',
            'staff_password' => 'required|string|min:8|confirmed',
        ]);

        $staff_account = new User($validatedData);
        $staff_account->password = bcrypt($validatedData['staff_password']);
        $staff_account->role = 1;
        $staff_account->save();

        return redirect()->back()->with('success', 'New staff added successfully!');
    }

    public function updateAdminAccount(Request $request, $id)
    {
        $validatedData = $request->validate([
            'admin_name' => 'required',
            'admin_email' => 'required|email|unique:users,email',
            'admin_password' => 'required|string|min:8|confirmed',
        ]);

        $admin_account = User::find($id);
        $admin_account->name = $validatedData['admin_name'];
        $admin_account->email = $validatedData['admin_email'];
        $admin_account->password = bcrypt($validatedData['admin_password']);
        $admin_account->update($validatedData);

        return redirect()->back()->with('success', 'Admin account updated successfully!');
    }

    public function updateStudentAccount(Request $request, $id)
    {
        $validatedData = $request->validate([
            'student_name' => 'required',
            'student_email' => 'required|email|unique:users,email',
            'student_password' => '<PASSWORD>|string|min:8|confirmed',
        ]);

        $student_account = User::find($id);
        $student_account->name = $validatedData['student_name'];
        $student_account->email = $validatedData['student_email'];
        $student_account->password = bcrypt($validatedData['student_password']);
        $student_account->update($validatedData);

        return redirect()->back()->with('success', 'Student account updated successfully!');
    }

    public function updateStaffAccount(Request $request, $id)
    {
        $validatedData = $request->validate([
            'staff_name' => 'required',
            'staff_email' => 'required|email|unique:users,email',
            'staff_password' => '<PASSWORD>|string|min:8|confirmed',
        ]);

        $staff_account = User::find($id);
        $staff_account->name = $validatedData['staff_name'];
        $staff_account->email = $validatedData['staff_email'];
        $staff_account->password = bcrypt($validatedData['staff_password']);
        $staff_account->update($validatedData);

        return redirect()->back()->with('success', 'Staff account updated successfully!');
    }

    public function deleteAdminAccount($id)
    {
        $admin_account = User::find($id);
        $admin_account->delete();

        return redirect()->back()->with('success', 'Admin account deleted successfully!');
    }

    public function deleteStudentAccount($id)
    {
        $student_account = User::find($id);
        $student_account->delete();

        return redirect()->back()->with('success', 'Student account deleted successfully!');
    }

    public function deleteStaffAccount($id)
    {
        $staff_account = User::find($id);
        $staff_account->delete();

        return redirect()->back()->with('success', 'Staff account deleted successfully!');
    }
}
