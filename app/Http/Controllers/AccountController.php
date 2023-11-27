<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

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
        return view('pages.admin-auth.accounts.create-admin-account');
    }
}
