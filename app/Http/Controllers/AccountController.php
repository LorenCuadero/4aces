<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Admin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Mail\SendAdminNotification;
use Illuminate\Support\Facades\Auth;


class AccountController extends Controller
{
    public function indexAdminAccounts(Request $request)
    {
        $users = User::select('users.*')
                    ->where('role', 2)
                    ->where('is_deleted', "=", "0");
                    if(!empty($request->email)){
                        $users = $users->where('email', 'like', '%'.$request->email.'%');
                    };

                    if(!empty($request->name)){
                        $users = $users->where('name', 'like', '%'.$request->name.'%');
                    };

                    if(!empty($request->date)){
                        $users = $users->whereDate('created_at', '=', $request->date);
                    };

                    if(!empty($request->searchbar)){
                        $users = $users->where('searchbar', 'like', '%'.$request->searchbar.'%');
                    };

        $users = $users->orderBy('name', 'asc')
                    // ->get(); KANI IF DILI MAG PAGINATION
                    ->paginate(20);

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

    public function searchAdminAccount(){

        $admins = User::select('users.*')
                    ->where('user_type', "=", "1")
                    ->where('is_deleted', "=", "0");
                    if(!empty(Request::get('email'))){
                        $admins = $admins->where('email', 'like', '%'.Request::get('email').'%');
                    };

                    if(!empty(Request::get('name'))){
                        $admins = $admins->where('name', 'like', '%'.Request::get('name').'%');
                    };

                    if(!empty(Request::get('date'))){
                        $admins = $admins->whereDate('created_at', '=', Request::get('date'));
                    };

                    if(!empty(Request::get('searchbar'))){
                        $admins = $admins->where('name', 'like', '%'.Request::get('searchbar').'%');
                    };


                    // if(!empty(Request::get('searchbar'))){
                    //     $admins = $admins->where('email', 'like', '%'.Request::get('searchbar').'%');
                    // }; NOT WORKING
        $admins = $admins->orderBy('id', 'asc')
                    // ->get(); KANI IF DILI MAG PAGINATION
                    ->paginate(20);

        return $admins;
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
        $request->validate([
            'email' => 'required|email|unique:users,email',
            'birthdate' => 'before:'. now()->subYears(18)->format('Y-m-d'),
        ]);

        $admin_account = new User();
        $admin_account->name = ucfirst(request()->input('first_name')) . ' ' . ucfirst(request()->input('last_name'));
        $admin_account->email = request()->input('email');
        $admin_account->password = bcrypt(request()->input('password'));
        $admin_account->role = 2;
        $admin_account->save();

        $admin = new Admin();
        $admin->first_name = request()->input('first_name') ;
        $admin->middle_name = request()->input('middle_name') ;
        $admin->last_name = request()->input('last_name') ;
        $admin->department = request()->input('department') ;
        $admin->birthdate = request()->input('birthdate');
        $admin->email = request()->input('email') ;
        $admin->password = bcrypt(request()->input('password')) ;
        $admin->contact_number = request()->input('contact_number') ;
        $admin->address = request()->input('address') ;
        $admin->gender = request()->input('gender') ;
        $admin->civil_status = request()->input('civil_status') ;
        $admin->save();

        $admin_name = request()->input('first_name'). ' '. request()->input('last_name');

        $defaultPassword = 'password';

        Mail::to($admin->email)->send(new SendAdminNotification($admin_name, $admin->email, $admin->password));

        return redirect()->back()->with('success', 'New admin added successfully!');
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

        if(!empty($admin_account)){
            $admin_account->is_deleted = 1;
            $admin_account->save();
            return redirect()->back()->with('success', 'Admin account deleted successfully!');
        }else{
            return redirect()->back()->with('error', 'Unexpected error!');
        }
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
