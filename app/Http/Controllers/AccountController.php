<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Admin;
use App\Models\Staff;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Mail\SendAdminNotification;
use Illuminate\Support\Facades\Auth;
use App\Services\StoreLogsService;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;

class AccountController extends Controller
{
    public function indexAdminAccounts(Request $request)
    {
        $users = User::join('admins', 'users.id', '=', 'admins.user_id')
            ->select('users.*', 'admins.*')
            ->where('users.is_deleted', "=", "0");;

        if (!empty($request->email)) {
            $users = $users->where(function ($query) use ($request) {
                $query->where('users.email', 'like', '%' . $request->email . '%')
                    ->orWhere('admins.email', 'like', '%' . $request->email . '%');
            });
        }

        if (!empty($request->name)) {
            $users = $users->where(function ($query) use ($request) {
                $query->where('users.name', 'like', '%' . $request->name . '%');
            });
        }

        if (!empty($request->date)) {
            $users = $users->whereDate('users.created_at', '=', $request->date);
        }

        if (!empty($request->searchbar)) {
            $users = $users->where(function ($query) use ($request) {
                $query->where('users.searchbar', 'like', '%' . $request->searchbar . '%')
                    ->orWhere('admins.searchbar', 'like', '%' . $request->searchbar . '%');
            });
        }

        $entriesPerPage = $request->input('entries', 10); // Default to 10 entries per page
        $users = $users->orderBy('name', 'asc')
            // ->get(); KANI IF DILI MAG PAGINATION
            ->paginate($entriesPerPage);

        $data['header_title'] = 'Admin Accounts |';

        return view('pages.admin-auth.accounts.admin-account', compact('users','entriesPerPage'), $data);

    }

    public function indexStudentsAccounts()
    {
        $users = User::where('role', 0)->get();
        return view('pages.admin-auth.accounts.student-account', compact('users'));
    }

    public function indexStaffAccounts(Request $request)
    {
        $users = User::join('staffs', 'users.id', '=', 'staffs.user_id')
            ->select('users.*', 'staffs.*')
            ->where('users.is_deleted', "=", "0");
        ;

        if (!empty($request->email)) {
            $users = $users->where(function ($query) use ($request) {
                $query->where('users.email', 'like', '%' . $request->email . '%')
                    ->orWhere('staffs.email', 'like', '%' . $request->email . '%');
            });
        }

        if (!empty($request->name)) {
            $users = $users->where(function ($query) use ($request) {
                $query->where('users.name', 'like', '%' . $request->name . '%');
            });
        }

        if (!empty($request->date)) {
            $users = $users->whereDate('users.created_at', '=', $request->date);
        }

        if (!empty($request->searchbar)) {
            $users = $users->where(function ($query) use ($request) {
                $query->where('users.searchbar', 'like', '%' . $request->searchbar . '%')
                    ->orWhere('staffs.searchbar', 'like', '%' . $request->searchbar . '%');
            });
        }

        $entriesPerPage = $request->input('entries', 10); // Default to 10 entries per page
        $users = $users->orderBy('name', 'asc')
            // ->get(); KANI IF DILI MAG PAGINATION
            ->paginate($entriesPerPage);
        $data['header_title'] = 'Staff Accounts |';
        return view('pages.admin-auth.accounts.staff-account', compact('users','entriesPerPage'), $data);
    }

    public function createAdminAccount()
    {
        return view('pages.admin-auth.accounts.admin.index');
    }

    public function createStaffAccount()
    {
        return view('pages.admin-auth.accounts.staff.index');
    }

    public function getAdminAccount($id)
    {
        $user = Admin::where('user_id', $id)->first();
        $data['header_title'] = 'Edit Admin |';
        return view('pages.admin-auth.accounts.edit-admin-account', compact('user'), $data);
    }

    public function searchAdminAccount()
    {

        $admins = User::select('users.*')
            ->where('user_type', "=", "1")
            ->where('is_deleted', "=", "0");
        if (!empty(Request::get('email'))) {
            $admins = $admins->where('email', 'like', '%' . Request::get('email') . '%');
        }
        ;

        if (!empty(Request::get('name'))) {
            $admins = $admins->where('name', 'like', '%' . Request::get('name') . '%');
        }
        ;

        if (!empty(Request::get('date'))) {
            $admins = $admins->whereDate('created_at', '=', Request::get('date'));
        }
        ;

        if (!empty(Request::get('searchbar'))) {
            $admins = $admins->where('name', 'like', '%' . Request::get('searchbar') . '%');
        }
        ;


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
        $user = Staff::where('user_id', $id)->first();
        // dd($user->id);
        $data['header_title'] = 'Edit Staff |';
        return view('pages.admin-auth.accounts.edit-staff-account', compact('user'), $data);
    }

    public function storeAdminAccount(Request $request)
    {
        $request->validate([
            'email' => 'required|email|unique:users,email',
            'birthdate' => 'before:' . now()->subYears(18)->format('Y-m-d'),
        ]);

        $admin_account = new User();
        $admin_account->name = ucfirst(request()->input('first_name')) . ' ' . ucfirst(request()->input('last_name'));
        $admin_account->email = request()->input('email');
        $admin_account->password = bcrypt(request()->input('password'));
        $admin_account->role = 2;
        $admin_account->save();

        $admin = new Admin();
        $admin->first_name = request()->input('first_name');
        $admin->middle_name = request()->input('middle_name');
        $admin->last_name = request()->input('last_name');
        $admin->department = request()->input('department');
        $admin->birthdate = request()->input('birthdate');
        $admin->email = request()->input('email');
        $admin->password = bcrypt(request()->input('password'));
        $admin->contact_number = request()->input('contact_number');
        $admin->address = trim(request()->input('address'));
        $admin->gender = request()->input('gender');
        $admin->civil_status = request()->input('civil_status');
        $admin->user_id = $admin_account->id;
        $admin->save();

        $admin_name = request()->input('first_name') . ' ' . request()->input('last_name');

        // Try to save the admin, and handle success/failure
        if ($admin->save()) {
            // Admin saved successfully
            $admin_name = request()->input('first_name') . ' ' . request()->input('last_name');

            // Log the action
            $action = "Added";
            StoreLogsService::storeLogs(auth()->user()->id, $action, "Admin Account", null, null, null);

            Mail::to($admin->email)->send(new SendAdminNotification($admin_name, $admin->email, $admin->password));

            return redirect()->back()->with('success', 'New admin added successfully!');
        } else {
            $admin_account->delete();
            return redirect()->back()->with('error', 'Failed to save admin. Please try again.')->withInput();
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
        // dd($request->all());
        $request->validate([
            'email' => 'required|email|unique:users,email',
            'password' => 'required|string|min:8',
            'contact_number' => 'nullable'
        ]);

        $staff_account = new User();
        $staff_account->name = ucfirst(request()->input('first_name')) . ' ' . ucfirst(request()->input('last_name'));
        $staff_account->email = request()->input('email');
        $staff_account->password = bcrypt(request()->input('password'));
        $staff_account->role = 1;
        $staff_account->save();

        $staff = new Staff();
        $staff->first_name = request()->input('first_name');
        if($request->middle_name == null){
            $staff->middle_name = "N/A";
        }else{
            $staff->middle_name = request()->input('middle_name');
        }
        $staff->last_name = request()->input('last_name');
        $staff->department = request()->input('department');
        $staff->birthdate = request()->input('birthdate');
        $staff->email = request()->input('email');
        $staff->password = bcrypt(request()->input('password'));
        $staff->contact_number = request()->input('contact_number');
        $staff->address = trim(request()->input('address'));
        $staff->gender = request()->input('gender');
        $staff->civil_status = request()->input('civil_status');
        $staff->user_id = $staff_account->id;
        // $staff->save();

        // // Try to save the staff, and handle success/failure
        if ($staff->save()) {
        //     // Admin saved successfully
            $staff_name = request()->input('first_name') . ' ' . request()->input('last_name');

            // Log the action
            $action = "Added";
            StoreLogsService::storeLogs(auth()->user()->id, $action, "Staff Account", null, null, null);

            Mail::to($staff->email)->send(new SendAdminNotification($staff_name, $staff->email, $staff->password));

            return redirect()->back()->with('success', 'New staff successfully!');
        } else {
            $staff_account->delete();
            return redirect()->back()->with('error', 'Failed to save staff. Please try again.')->withInput();
        }
    }

    public function updateAdminAccount(Request $request, $id)
    {
        $validatedData = $request->validate([
            'first_name' => 'required',
            'middle_name' => 'nullable',
            'last_name' =>'required',
            'department' =>'required',
            'birthdate' =>'required|date',
            'address' =>'required',
            'contact_number' => 'nullable|regex:/^\+63\d{10}$/',
            'gender' => 'required',
            'civil_status' => 'required',
            'email' => 'required|email|unique:users,email,'.$id
        ]);

        // dd($validatedData);
        // dd($request->all());

        $user = User::findOrFail($id);

        $user->fill([
            'name' => $validatedData['first_name'] . ' ' . $validatedData['last_name'],
            'email' => $validatedData['email']
        ]);

        if (!empty($validatedData['password'])) {
            $user->password = Hash::make($validatedData['password']);
        }
        $user->save();

        $admin = Admin::where('user_id', $id)->firstOrFail();
        $admin->fill([
            'first_name' => $validatedData['first_name'],
            'middle_name' => $validatedData['middle_name'],
            'last_name' => $validatedData['last_name'],
            'department' => $validatedData['department'],
            'birthdate' => $validatedData['birthdate'],
            'address' => $validatedData['address'],
            'contact_number' => $validatedData['contact_number'],
            'gender' => $validatedData['gender'],
            'civil_status' => $validatedData['civil_status'],
        ]);
        if (!empty($validatedData['password'])) {
            $admin->password = Hash::make($validatedData['password']);
        }
        $admin->save();

        $action = "Updated";
        StoreLogsService::storeLogs(auth()->user()->id, $action, "Admin Account", null, null, null);

        session()->flash('success', 'Admin updated successfully.');

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
        // $validatedData = $request->validate([
        //     'staff_name' => 'required',
        //     'staff_email' => 'required|email|unique:users,email',
        //     'staff_password' => '<PASSWORD>|string|min:8|confirmed',
        // ]);

        // $staff_account = User::find($id);
        // $staff_account->name = $validatedData['staff_name'];
        // $staff_account->email = $validatedData['staff_email'];
        // $staff_account->password = bcrypt($validatedData['staff_password']);
        // $staff_account->update($validatedData);

        // return redirect()->back()->with('success', 'Staff account updated successfully!');


        $validatedData = $request->validate([
            'first_name' => 'required',
            'middle_name' => 'nullable',
            'last_name' => 'required',
            'department' => 'required',
            'birthdate' => 'required|date',
            'address' => 'required',
            'contact_number' => 'nullable|regex:/^\+63\d{10}$/',
            'gender' => 'required',
            'civil_status' => 'required',
            // 'password' => 'min:8',
            'email' => 'required|email|unique:users,email,' . $id
        ]);

        // dd($validatedData);

        $user = User::findOrFail($id);
        $user->fill([
            'name' => $validatedData['first_name'] . ' ' . $validatedData['last_name'],
            'email' => $validatedData['email']
        ]);
        if (!empty($validatedData['password'])) {
            $user->password = Hash::make($validatedData['password']);
        }
        $user->save();

        $staff = Staff::where('user_id', $id)->firstOrFail();
        $staff->fill([
            'first_name' => $validatedData['first_name'],
            'middle_name' => $validatedData['middle_name'],
            'last_name' => $validatedData['last_name'],
            'department' => $validatedData['department'],
            'birthdate' => $validatedData['birthdate'],
            'address' => $validatedData['address'],
            'contact_number' => $validatedData['contact_number'],
            'gender' => $validatedData['gender'],
            'civil_status' => $validatedData['civil_status'],
        ]);
        if (!empty($validatedData['password'])) {
            $staff->password = Hash::make($validatedData['password']);
        }
        $staff->save();

        $action = "Updated";
        StoreLogsService::storeLogs(auth()->user()->id, $action, "Staff Account", null, null, null);

        session()->flash('success', 'Staff updated successfully.');

        return redirect()->back()->with('success', 'Staff account updated successfully!');
    }

    public function deleteAdminAccount(Request $request, $id)
    {
        $admin_account = User::find($id);

        // if (!empty($admin_account)) {
        //     $admin_account->is_deleted = 1;
        //     $admin_account->save();

        //     $action = "Deleted";
        //     StoreLogsService::storeLogs(auth()->user()->id, $action, "Admin Account", null, null, null);

        //     return redirect()->back()->with('success', 'Admin account deleted successfully!');
        // } else {
        //     return redirect()->back()->with('error', 'Unexpected error!');
        // }
        if ($admin_account) {
            if ($request->has('soft_delete')) {
                // Soft delete by setting 'is_deleted' to 1
                $admin_account->fill(['is_deleted' => 1]);
                $admin_account->save();

                // Log
                $action = "Deleted";
                StoreLogsService::storeLogs(auth()->user()->id, $action, "Admin Account", null, null, null);

                return redirect()->route('admin.admin-accounts')->with('success', 'Admin account deleted successfully.');
            } else {
                return redirect()->back()->with('error', 'Unexpected error!');
            }
        }else{
            return redirect()->back()->with('error', 'Admin account not found!');
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

        if (!empty($staff_account)) {
            $staff_account->is_deleted = 1;
            $staff_account->save();

            $action = "Deleted";
            StoreLogsService::storeLogs(auth()->user()->id, $action, "Staff Account", null, null, null);

            return redirect()->back()->with('success', 'Staff account deleted successfully!');
        } else {
            return redirect()->back()->with('error', 'Unexpected error!');
        }
    }
}
