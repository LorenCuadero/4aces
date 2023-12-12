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
use Illuminate\Support\Facades\Hash;
use Carbon\Carbon;
use App\Models\Student;
use App\Mail\SendStudentNotification;
use App\Mail\SendStaffNotification;
use Illuminate\Validation\Rule;


class AccountController extends Controller {
    public function indexAdminAccounts(Request $request) {
        if(Auth::user()->role != '2') {
            return redirect()->back()->with('error', 'You do not have permission to access this page');
        }

        $users = User::join('admins', 'users.id', '=', 'admins.user_id')
            ->select('users.*', 'admins.*')
            ->where('users.is_deleted', "=", "0");
        ;

        if(!empty($request->email)) {
            $users = $users->where(function ($query) use ($request) {
                $query->where('users.email', 'like', '%'.$request->email.'%')
                    ->orWhere('admins.email', 'like', '%'.$request->email.'%');
            });
        }

        if(!empty($request->name)) {
            $users = $users->where(function ($query) use ($request) {
                $query->where('users.name', 'like', '%'.$request->name.'%');
            });
        }

        if(!empty($request->date)) {
            $users = $users->whereDate('users.created_at', '=', $request->date);
        }

        if(!empty($request->searchbar)) {
            $users = $users->where(function ($query) use ($request) {
                $query->where('users.searchbar', 'like', '%'.$request->searchbar.'%')
                    ->orWhere('admins.searchbar', 'like', '%'.$request->searchbar.'%');
            });
        }

        $entriesPerPage = $request->input('entries', 10); // Default to 10 entries per page
        $users = $users->orderByRaw("SUBSTRING_INDEX(name, ' ', -1) ASC")
            // ->get(); KANI IF DILI MAG PAGINATION
            ->paginate($entriesPerPage);

        $data['header_title'] = 'Admin Accounts |';

        return view('pages.admin-auth.accounts.admin-account', compact('users', 'entriesPerPage'), $data);

    }

    public function indexStaffAccounts(Request $request) {
        if(Auth::user()->role != '2') {
            return redirect()->back()->with('error', 'You do not have permission to access this page');
        }

        $users = User::join('staffs', 'users.id', '=', 'staffs.user_id')
            ->select('users.*', 'staffs.*')
            ->where('users.is_deleted', "=", "0");
        ;

        if(!empty($request->email)) {
            $users = $users->where(function ($query) use ($request) {
                $query->where('users.email', 'like', '%'.$request->email.'%')
                    ->orWhere('staffs.email', 'like', '%'.$request->email.'%');
            });
        }

        if(!empty($request->name)) {
            $users = $users->where(function ($query) use ($request) {
                $query->where('users.name', 'like', '%'.$request->name.'%');
            });
        }

        if(!empty($request->date)) {
            $users = $users->whereDate('users.created_at', '=', $request->date);
        }

        if(!empty($request->searchbar)) {
            $users = $users->where(function ($query) use ($request) {
                $query->where('users.searchbar', 'like', '%'.$request->searchbar.'%')
                    ->orWhere('staffs.searchbar', 'like', '%'.$request->searchbar.'%');
            });
        }

        $entriesPerPage = $request->input('entries', 10); // Default to 10 entries per page
        $users = $users->orderBy('name', 'asc')
            // ->get(); KANI IF DILI MAG PAGINATION
            ->paginate($entriesPerPage);
        $data['header_title'] = 'Staff Accounts |';
        return view('pages.admin-auth.accounts.staff-account', compact('users', 'entriesPerPage'), $data);
    }

    public function indexStudentsAccounts(Request $request) {
        // $users = User::where('role', 0)->get();
        // return view('pages.admin-auth.accounts.student-account', compact('users'));
        if(Auth::user()->role != '2') {
            return redirect()->back()->with('error', 'You do not have permission to access this page');
        }

        $users = User::join('students', 'users.id', '=', 'students.user_id')
            ->select('users.*', 'students.*')
            ->where('users.is_deleted', "=", "0");
        ;

        if(!empty($request->email)) {
            $users = $users->where(function ($query) use ($request) {
                $query->where('users.email', 'like', '%'.$request->email.'%')
                    ->orWhere('students.email', 'like', '%'.$request->email.'%');
            });
        }

        if(!empty($request->name)) {
            $users = $users->where(function ($query) use ($request) {
                $query->where('students.name', 'like', '%'.$request->name.'%');
            });
        }

        if(!empty($request->date)) {
            $users = $users->whereDate('users.created_at', '=', $request->date);
        }

        if(!empty($request->searchbar)) {
            $users = $users->where(function ($query) use ($request) {
                $query->where('users.searchbar', 'like', '%'.$request->searchbar.'%')
                    ->orWhere('students.searchbar', 'like', '%'.$request->searchbar.'%');
            });
        }

        $entriesPerPage = $request->input('entries', 10); // Default to 10 entries per page
        $users = $users->orderBy('name', 'asc')
            // ->get(); KANI IF DILI MAG PAGINATION
            ->paginate($entriesPerPage);
        $data['header_title'] = 'Student Accounts |';

        return view('pages.admin-auth.accounts.student-account', compact('users', 'entriesPerPage'), $data);
    }

    public function createAdminAccount() {
        if(Auth::user()->role != '2') {
            return redirect()->back()->with('error', 'You do not have permission to access this page');
        }

        return view('pages.admin-auth.accounts.admin.index');
    }

    public function createStaffAccount() {
        if(Auth::user()->role != '2') {
            return redirect()->back()->with('error', 'You do not have permission to access this page');
        }

        return view('pages.admin-auth.accounts.staff.index');
    }

    public function createStudentAccount() {
        if(Auth::user()->role != '2') {
            return redirect()->back()->with('error', 'You do not have permission to access this page');
        }

        return view('pages.admin-auth.accounts.student.index');
    }


    public function getAdminAccount($id) {

        // $status = User::where('id', $id)->first();
        // dd($status->status);
        if(Auth::user()->role != '2') {
            return redirect()->back()->with('error', 'You do not have permission to access this page');
        }

        $user = Admin::where('user_id', $id)->first();
        $data['header_title'] = 'Edit Admin |';
        return view('pages.admin-auth.accounts.edit-admin-account', compact('user'), $data);
    }


    public function getStaffAccount($id) {
        if(Auth::user()->role != '2') {
            return redirect()->back()->with('error', 'You do not have permission to access this page');
        }

        $user = Staff::where('user_id', $id)->first();
        $data['header_title'] = 'Edit Staff |';
        return view('pages.admin-auth.accounts.edit-staff-account', compact('user'), $data);
    }

    public function getStudentAccount($id) {
        if(Auth::user()->role != '2') {
            return redirect()->back()->with('error', 'You do not have permission to access this page');
        }

        $user = Student::where('user_id', $id)->first();
        $data['header_title'] = 'Edit Student |';
        return view('pages.admin-auth.accounts.edit-student-account', compact('user'));
    }

    public function storeAdminAccount(Request $request) {
        if(Auth::user()->role != '2') {
            return redirect()->back()->with('error', 'You do not have permission to access this page');
        }

        $admin_account = new User();
        $admin_account->name = ucfirst(request()->input('first_name')).' '.ucfirst(request()->input('last_name'));
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

        $admin_name = request()->input('first_name').' '.request()->input('last_name');

        // Try to save the admin, and handle success/failure
        if($admin->save()) {
            // Admin saved successfully
            $admin_name = request()->input('first_name').' '.request()->input('last_name');

            // Log the action
            $action = "Added";
            StoreLogsService::storeLogs(auth()->user()->id, $action, "Admin Account", null, null, null);

            Mail::to($admin->email)->send(new SendAdminNotification($admin_name, $admin->email, request()->input('password')));
            return redirect()->back()->with('success', 'New admin added successfully!');
        } else {
            $admin_account->delete();
            return redirect()->back()->with('error', 'Failed to save admin. Please try again.')->withInput();
        }
    }

    public function storeStaffAccount(Request $request) {
        // dd($request->all());
        if(Auth::user()->role != '2') {
            return redirect()->back()->with('error', 'You do not have permission to access this page');
        }

        $request->validate([
            'email' => 'required|email|unique:users,email',
            'password' => 'string|min:8',
            'contact_number' => 'nullable'
        ]);

        $staff_account = new User();
        $staff_account->name = ucfirst(request()->input('first_name')).' '.ucfirst(request()->input('last_name'));
        $staff_account->email = request()->input('email');
        $staff_account->password = bcrypt('$t@ffP@$$w0rd');
        $staff_account->role = 1;
        $staff_account->save();

        $staff = new Staff();
        $staff->first_name = request()->input('first_name');
        if($request->middle_name == null) {
            $staff->middle_name = "N/A";
        } else {
            $staff->middle_name = request()->input('middle_name');
        }
        $staff->last_name = request()->input('last_name');
        $staff->department = request()->input('department');
        $staff->birthdate = request()->input('birthdate');
        $staff->email = request()->input('email');
        $staff->password = bcrypt('$t@ffP@$$w0rd');
        $staff->contact_number = request()->input('contact_number');
        $staff->address = trim(request()->input('address'));
        $staff->gender = request()->input('gender');
        $staff->civil_status = request()->input('civil_status');
        $staff->user_id = $staff_account->id;
        $staff->save();

        // // Try to save the staff, and handle success/failure
        if($staff->save()) {
            //     // Admin saved successfully
            $staff_name = request()->input('first_name').' '.request()->input('last_name');

            $defaultPassUnHashed = '$t@ffP@$$w0rd';

            $action = "Added";
            StoreLogsService::storeLogs(auth()->user()->id, $action, "Staff", $staff->id, null, null);

            Mail::to($staff->email)->send(new SendStaffNotification($staff_name, $staff->email, $defaultPassUnHashed));

            return redirect()->back()->with('success', 'New staff added successfully!');
        } else {
            $staff_account->delete();
            return redirect()->back()->with('error', 'Failed to save staff. Please try again.')->withInput();
        }
    }

    public function storeStudentAccount(Request $request) {
        // dd($request->all());
        if(Auth::user()->role != '2') {
            return redirect()->back()->with('error', 'You do not have permission to access this page');
        }

        $validatedData = $request->validate([
            'first_name' => 'required',
            'middle_name' => 'nullable',
            'suffix' => 'nullable',
            'last_name' => 'required',
            'gender' => 'required',
            'contact_number' => 'nullable',
            'birthdate' => 'required|date',
            'address' => 'required',
            'parent_name' => 'required',
            'parent_contact' => 'required',
            'batch_year' => 'required',
            'joined' => 'required|date',
            'email' => 'unique:students,email',
        ]);

        // dd($validatedData);

        if(str_word_count($validatedData['first_name']) > 1) {
            // If more than one word, replace spaces with underscores
            $first_name = strtolower(str_replace(' ', '_', $validatedData['first_name']));
        } else {
            // If only one word, use the name as is
            $first_name = strtolower($validatedData['first_name']);
        }

        $email = strtolower($first_name.'.'.$validatedData['last_name'].'@student.passerellesnumeriques.org');
        // dd($email);

        $student_account = new User();
        $student_account->name = ucfirst($validatedData['first_name']).' '.ucfirst($validatedData['last_name']);
        $student_account->email = $email;
        $student_account->password = bcrypt('d3f@ultP@$$w0rd');
        $student_account->role = 0;
        $student_account->save();

        $student = new Student();
        $student->first_name = $validatedData['first_name'];
        if($validatedData['middle_name'] == null) {
            $student->middle_name = "N/A";
        } else {
            $student->middle_name = $validatedData['middle_name'];
        }
        $student->last_name = $validatedData['last_name'];
        if($student->suffix == 'None') {
            $student->suffix = null;
        }
        $student->birthdate = $validatedData['birthdate'];
        $student->email = $email;
        $student->password = bcrypt('d3f@ultP@$$w0rd');
        $student->contact_number = $validatedData['contact_number'];
        $student->address = trim($validatedData['address']);
        $student->gender = $validatedData['gender'];
        $student->parent_name = $validatedData['parent_name'];
        $student->parent_contact = $validatedData['parent_contact'];

        $currentYear = now()->year;
        $endYear = $currentYear + 2;
        if($validatedData['batch_year'] > $endYear) {
            return redirect()->back()->with('error', 'Batch year invalid. Please try again.');
        } else {
            $student->batch_year = $validatedData['batch_year'];
        }
        $student->joined = $validatedData['joined'];
        $student->user_id = $student_account->id;

        $student->save();

        // // Try to save the staff, and handle success/failure
        if($student->save()) {
            //     // Admin saved successfully
            $student_name = request()->input('first_name').' '.request()->input('last_name');

            $defaultPassUnHashed = 'd3f@ultP@$$w0rd';

            $action = "Added";
            StoreLogsService::storeLogs(auth()->user()->id, $action, "Student", $student->id, null, $validatedData['batch_year']);

            Mail::to($student->email)->send(new SendStudentNotification($student_name, $student->email, $defaultPassUnHashed));
            return redirect()->back()->with('success', 'New student added successfully!');
        } else {
            $student_account->delete();
            return redirect()->back()->with('error', 'Failed to save staff. Please try again.')->withInput();
        }
    }

    public function updateAdminAccount(Request $request, $id) {
        // dd($request->all());
        if(Auth::user()->role != '2') {
            return redirect()->back()->with('error', 'You do not have permission to access this page');
        }

        $validatedData = $request->validate([
            'first_name' => 'required',
            'middle_name' => 'nullable',
            'last_name' => 'required',
            'department' => 'required',
            'birthdate' => 'required|date',
            'address' => 'required',
            'contact_number' => 'nullable',
            'gender' => 'required',
            'civil_status' => 'required',
            'status' => 'required',
            'password' => 'nullable|min:8',
            'email' => 'required|email|unique:users,email,'.$id
        ]);

        $user = User::findOrFail($id);

        $user->fill([
            'name' => $validatedData['first_name'].' '.$validatedData['last_name'],
            'email' => $validatedData['email']
        ]);
        if(!empty($validatedData['password'])) {
            $user->password = Hash::make($validatedData['password']);
        }
        if($user->status != $validatedData['status']) {
            // Update the status value
            $user->status = $validatedData['status'];
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
        if(!empty($validatedData['password'])) {
            $admin->password = Hash::make($validatedData['password']);
        }
        $admin->save();

        $action = "Updated";
        StoreLogsService::storeLogs(auth()->user()->id, $action, "Admin Account", null, null, null);

        session()->flash('success', 'Admin updated successfully.');

        return redirect()->back()->with('success', 'Admin account updated successfully!');

    }

    public function updateStudentAccount(Request $request, $id) {
        // $validatedData = $request->validate([
        //     'student_name' => 'required',
        //     'student_email' => 'required|email|unique:users,email',
        //     'student_password' => '<PASSWORD>|string|min:8|confirmed',
        // ]);

        // $student_account = User::find($id);
        // $student_account->name = $validatedData['student_name'];
        // $student_account->email = $validatedData['student_email'];
        // $student_account->password = bcrypt($validatedData['student_password']);
        // $student_account->update($validatedData);

        // return redirect()->back()->with('success', 'Student account updated successfully!');

        if(Auth::user()->role != '2') {
            return redirect()->back()->with('error', 'You do not have permission to access this page');
        }

        $validatedData = $request->validate([
            'first_name' => 'required',
            'middle_name' => 'nullable',
            'suffix' => 'nullable',
            'last_name' => 'required',
            'gender' => 'required',
            'contact_number' => 'nullable',
            'birthdate' => 'required|date',
            'address' => 'required',
            'parent_name' => 'required',
            'parent_contact' => 'required',
            'batch_year' => 'required',
            'joined' => 'required|date',
            'email' => 'required|email|unique:users,email,'.$id
        ]);

        $user = User::findOrFail($id);

        // dd($user);

        $user->fill([
            'name' => $validatedData['first_name'].' '.$validatedData['last_name'],
        ]);
        $user->save();

        $student = Student::where('user_id', $id)->firstOrFail();
        $student->fill([
            'first_name' => $validatedData['first_name'],
            'middle_name' => $validatedData['middle_name'],
            'last_name' => $validatedData['last_name'],
            'suffix' => $validatedData['suffix'],
            'gender' => $validatedData['gender'],
            'contact_number' => $validatedData['contact_number'],
            'birthdate' => $validatedData['birthdate'],
            'address' => $validatedData['address'],
            'parent_name' => $validatedData['parent_name'],
            'parent_contact' => $validatedData['parent_contact'],
            'batch_year' => $validatedData['batch_year'],
            'joined' => $validatedData['joined'],
        ]);
        $student->save();

        $action = "Updated";
        StoreLogsService::storeLogs(auth()->user()->id, $action, "Student Account", null, null, null);

        session()->flash('success', 'Student updated successfully.');

        return redirect()->back()->with('success', 'Student account updated successfully!');
    }

    public function updateStaffAccount(Request $request, $id) {
        // dd($request->all());
        if(Auth::user()->role != '2') {
            return redirect()->back()->with('error', 'You do not have permission to access this page');
        }

        $validatedData = $request->validate([
            'first_name' => 'required',
            'middle_name' => 'nullable',
            'last_name' => 'required',
            'department' => 'required',
            'birthdate' => 'required|date',
            'address' => 'required',
            'gender' => 'required',
            'civil_status' => 'required',
            'contact_number' => 'nullable|regex:/^(?:\+63)?\d{10}$/i',
            'password' => 'nullable|min:8',
            'email' => 'required|email|unique:users,email,'.$id
        ]);

        $user = User::findOrFail($id);

        // dd($user);

        $user->fill([
            'name' => $validatedData['first_name'].' '.$validatedData['last_name'],
            'email' => $validatedData['email']
        ]);

        if(!empty($validatedData['password'])) {
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
        if(!empty($validatedData['password'])) {
            $staff->password = Hash::make($validatedData['password']);
        }
        $staff->save();

        $action = "Updated";
        StoreLogsService::storeLogs(auth()->user()->id, $action, "Staff Account", null, null, null);

        session()->flash('success', 'Staff updated successfully.');

        return redirect()->back()->with('success', 'Staff account updated successfully!');
    }
    public function deleteAdminAccount($id) {
        if(Auth::user()->role != '2') {
            return redirect()->back()->with('error', 'You do not have permission to access this page');
        }

        $admin_account = User::find($id);

        if($admin_account) {
            // Soft delete by setting 'is_deleted' to 1
            $admin_account->fill(['is_deleted' => 1]);
            $admin_account->save();
            // $admin_account->update(['is_deleted' => 1]);

            // Log
            $action = "Deleted";
            StoreLogsService::storeLogs(auth()->user()->id, $action, "Admin Account", null, null, null);

            return redirect()->route('admin.admin-accounts')->with('success', 'Admin account deleted successfully.');

        } else {
            return redirect()->back()->with('error', 'Admin account not found!');
        }

    }

    public function softDeleteAdminAccount($id) {
        if(Auth::user()->role != '2') {
            return redirect()->back()->with('error', 'You do not have permission to access this page.');
        } else if(Auth::user()->id == $id) {
            return redirect()->back()->with('error', 'Error: Unable to Delete Account');
        }

        $admin_account = User::find($id);

        if($admin_account) {

            $admin_account->is_deleted = 1;
            $admin_account->deleted_at = Carbon::now();
            $admin_account->save();

            // Log
            $action = "Soft Deleted";
            StoreLogsService::storeLogs(auth()->user()->id, $action, "Admin Account", null, null, null);

            return redirect()->route('admin.admin-accounts')->with('success', 'Admin account soft deleted successfully.');
        } else {
            return redirect()->back()->with('error', 'Admin account not found!');
        }
    }

    public function deleteStudentAccount($id) {
        if(Auth::user()->role != '2') {
            return redirect()->back()->with('error', 'You do not have permission to access this page');
        }

        $student_account = User::find($id);
        $student_account->delete();

        return redirect()->back()->with('success', 'Student account deleted successfully!');
    }

    public function softDeleteStaffAccount($id) {
        if(Auth::user()->role != '2') {
            return redirect()->back()->with('error', 'You do not have permission to access this page');
        }

        $staff_account = User::find($id);

        if($staff_account) {

            $staff_account->is_deleted = 1;
            $staff_account->deleted_at = Carbon::now();
            $staff_account->save();

            // Log
            $action = "Soft Deleted";
            StoreLogsService::storeLogs(auth()->user()->id, $action, "Staff Account", null, null, null);

            return redirect()->route('admin.staff-accounts')->with('success', 'Staff account soft deleted successfully.');
        } else {
            return redirect()->back()->with('error', 'Staff account not found!');
        }

    }
    public function softDeleteStudentAccount($id) {
        if(Auth::user()->role != '2') {
            return redirect()->back()->with('error', 'You do not have permission to access this page');
        }

        $student_account = User::find($id);

        if($student_account) {

            $student_account->is_deleted = 1;
            $student_account->deleted_at = Carbon::now();
            $student_account->save();

            // Log
            $action = "Soft Deleted";
            StoreLogsService::storeLogs(auth()->user()->id, $action, "Student Account", null, null, null);

            return redirect()->route('admin.staff-accounts')->with('success', 'Student account soft deleted successfully.');
        } else {
            return redirect()->back()->with('error', 'Student account not found!');
        }

    }

    // public function deleteStudentAccount($id) {
    //     $student_account = User::find($id);
    //     $student_account->delete();

    //     return redirect()->back()->with('success', 'Student account deleted successfully!');
    // }


    public function deleteStaffAccount($id) {
        if(Auth::user()->role != '2') {
            return redirect()->back()->with('error', 'You do not have permission to access this page');
        }

        $staff_account = User::find($id);

        if(!empty($staff_account)) {
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
