<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Managers\AuthManager;
use App\Http\Requests\AuthLoginRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Request;
use Illuminate\Support\Facades\Session;

class AuthController extends Controller
{
    // protected AuthManager $manager;
    
    // public function __construct(AuthManager $manager)
    // {
    //     $this->manager = $manager;
    // }

    // public function index()
    // {
    //     return view('pages.guest.auth.login');
    // }

    // public function login(AuthLoginRequest $request)
    // {
    //     $rtn = null;
    //     $managerResponse = $this->manager->login();

    //     if ($managerResponse->isSuccessDefault()) {
    //         $rtn = redirect()
    //             ->intended('/dashboard')
    //             ->with('success', __('messages.success.login'));
    //     } elseif ($managerResponse->isErrorDefault()) {
    //         $rtn = redirect()
    //             ->back()
    //             ->with('error', __('messages.custom.credentials'))
    //             ->withInput($request->only('username'));
    //     } else {
    //         $rtn = redirect()
    //             ->back()
    //             ->withInput()
    //             ->with('error', __('messages.request.invalid'));
    //     }

    //     return $rtn;
    // }

    public function logout(Request $request)
    {
        Auth::logout();
        Session::invalidate();
        Session::regenerate();
        
        return redirect('/');
    }
}
