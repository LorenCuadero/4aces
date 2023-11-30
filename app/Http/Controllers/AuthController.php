<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Mail\SendOTPMail;
use App\Models\User;
use App\Services\StoreLogsService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use App\Mail\ForgotPasswordMail;

class AuthController extends Controller
{
    public function login(Request $request)
    {
        $email = $request->input('email');

        if ($request->input('email') == null && $request->input('password') == null) {
            return redirect()->back()->with('error-all-required', 'Email and password are required');
        } else if ($request->input('email') != null && $request->input('password') == null) {
            return redirect()->back()->withInput(compact('email'))->with('error-password-required', 'Password is required');
        } else if ($request->input('email') == null && $request->input('password') != null) {
            return redirect()->back()->with('error-email-required', 'Email is required');
        }

        $user = User::where('email', $request->input('email'))->first();

        if (!$user) {
            return redirect()->back()->withInput(compact('email'))->with('error-email-no-found', 'Email not found.');
        }

        if (!Hash::check($request->input('password'), $user->password)) {
            return redirect()->back()->withInput(compact('email'))->with('error-incorrect-password', 'Incorrect password.');
        }

        $otp = rand(100000, 999999);

        $user->otp = $otp;
        $user_email = $user->email;

        $user->save();

        Mail::to($user->email)->send(new SendOTPMail($otp, $user->email));

        return view('otp_verification', compact('user_email'));
    }

    public function loginPage()
    {
        return view('pages.welcome');
    }

    public function logout(Request $request)
    {
        Auth::logout();
        Session::invalidate();
        Session::regenerate();

        return redirect('/');
    }

    public function verifyOTP(Request $request)
    {
        // Validate the submitted OTP and email
        $request->validate([
            'email' => 'required|email',
            'otp1' => 'required|numeric',
            'otp2' => 'required|numeric',
            'otp3' => 'required|numeric',
            'otp4' => 'required|numeric',
            'otp5' => 'required|numeric',
            'otp6' => 'required|numeric',
        ]);

        // Get the user by their email
        $user = User::where('email', $request->input('email'))->first();

        $user_email = $user->email;

        $otp = $request->input('otp1') . $request->input('otp2') . $request->input('otp3') . $request->input('otp4') . $request->input('otp5') . $request->input('otp6');

        if (!$user) {
            dd('User not found');
            // User not found, you may want to handle this differently
            return redirect()->route('login')->with('error', 'User not found.');
        }

        // Check if the submitted OTP matches the one stored in the user's record
        if ($otp == $user->otp) {
            // Log the user in
            Auth::login($user);

            // Redirect to the intended dashboard based on the user's role
            if ($user->role == '0') {
                return redirect()->route('payable.index');
            } elseif ($user->role == '1') {
                return redirect()->route('students.index');
            } else {
                return redirect()->route('dashboard.index');
            }
        } else if (strlen($request->input('otp')) > 6) {
            return view('otp_verification', compact('user_email'))
                ->withErrors(['error' => 'OTP is incorrect.']);
        } else if ($request->input('otp') != $user->otp) {
            return view('otp_verification', compact('user_email'))
                ->withErrors(['error' => 'OTP is incorrect.']);
        }
    }

    public function authorizedRedirect()
    {
        if (Auth::user()->role == '0') {
            return redirect()->route('payable.index');
        } elseif (Auth::user()->role == '1') {
            return redirect()->route('students.index');
        } else {
            return redirect()->route('dashboard.index');
        }
    }


    public function forgotPassword()
    {
        return view('forgot');
    }

    public function postRecover(Request $request)
    {

        $request->validate([
            'email' => 'required|email',
        ]);

        $user = User::where('email', $request->input('email'))->first();

        if (!$user) {
            return redirect()->back()->with('email-not-found', 'The provided email is not associated with our system. Please enter a valid email linked to your account.');
        }

        // Generate a random OTP
        $otp = rand(100000, 999999);

        // Store the OTP in the user's record (you may use a different storage method)
        $user->otp = $otp;
        $user_email = $user->email;
        $user->save();

        Mail::to($user->email)->send(new SendOTPMail($otp, $user->email));

        // Pass both email and OTP to the OTP verification view for recovery
        return view('recover-by-otp', compact('user_email'));
    }

    public function recoverOTP(Request $request)
    {
        $otp = $request->input('otp1') . $request->input('otp2') . $request->input('otp3') . $request->input('otp4') . $request->input('otp5') . $request->input('otp6');

        if ($otp == null) {
            return redirect()->back()->with('error', 'OTP not found.');
        }

        $user = User::where('email', $request->input('email'))->first();
        $user_email = $user->email;

        if (!$user) {
            return redirect()->route('login')->with('error', 'User not found, please try again.');
        }

        if ($otp == $user->otp) {
            return view('reset', compact('user_email'))->with('success', 'Password reset was successful!');
        } else if ($otp != $user->otp) {
            return redirect()->back();
        }
    }

    public function submitReset(Request $request)
    {
        $user = User::where('email', $request->input('email'))->first();
        $user_email = $request->input('email');

        $error = null; // Initialize the variable

        if ($request->input('password') != $request->input('cpassword')) {
            $error = 'Passwords do not match.';
        } else if ($request->input('password') == null) {
            $error = 'Password cannot be empty.';
        } else if (strlen($request->input('password')) < 8) {
            $error = 'Password must be at least 8 characters.';
        } else if ($request->input('cpassword') == null) {
            $error = 'Confirm password cannot be empty.';
        }

        if ($error) {
            return view('reset', compact('error', 'user_email'));
        }

        if ($user) {
            $user->password = Hash::make($request->input('password'));
            $user->save();

            $action = "Changed password";
            StoreLogsService::storeLogs($user->id, $action, "Account", null, null, null);
            return redirect()->route('login')->with('success', 'Password changed successfully.');
        } else {
            return view('reset', compact('error', 'user_email'));
        }
    }

    public function confirm_changes(Request $request)
    {
        $user = User::where('email', $request->input('email'))->first();

        if (!$user) {
            return redirect()->back()->with('error', 'Email not found.');
        }

        $user->password = Hash::make($request->input('password'));
        $user->save();

        if ($request->has('keep_logged_in')) {
            Auth::login($user);

            if ($user->role == '0') {
                return redirect()->route('payable.index');
            } elseif ($user->role == '1') {
                return redirect()->route('students.index');
            } else {
                return redirect()->route('dashboard.index');
            }
        }

        Auth::logout();
        Session::invalidate();
        Session::regenerate();

        return redirect('/')->with('success', 'Password changed successfully.');
    }

    public function validate_from_current_pass(Request $request)
    {
        $user = User::where('email', $request->input('email'))->first();
        $user_email = $user->email;

        if (!$user) {
            return redirect()->back()->with('email-not-found', 'Email not found');
        }

        if (!Hash::check($request->input('current_password'), $user->password)) {
            return redirect()->back()->with('incorrect-password', 'Incorrect password');
        }

        return view('reset-pass-auth', compact('user_email'));
    }
}
