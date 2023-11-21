<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Mail\SendOTPMail;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function login(Request $request)
    {
        // Validate the email
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        // Check if the email exists in the database
        $user = User::where('email', $request->input('email'))->first();

        if (!$user) {
            // Email not found, show an error message
            return redirect()->back()->with('email-not-found', 'Email not found.');
        }

        // Email found, validate the password
        if (!Hash::check($request->input('password'), $user->password)) {
            // Incorrect password, show an error message
            return redirect()->back()->with('incorrect-password', 'Incorrect password.');
        }

        // Generate a random OTP
        $otp = rand(100000, 999999);

        // Store the OTP in the user's record (you may use a different storage method)
        $user->otp = $otp;
        $user_email = $user->email;

        $user->save();

        // Send the OTP to the user's email
        Mail::to($user->email)->send(new SendOTPMail($otp, $user->email));

        // Pass both email and OTP to the OTP verification view
        return view('otp_verification', compact('user_email'));
    }

    public function loginPage()
    {
        return view('welcome');
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
            'otp' => 'required|numeric|min:100000|max:999999',
        ]);

        // Get the user by their email
        $user = User::where('email', $request->input('email'))->first();

        if (!$user) {
            // User not found, you may want to handle this differently
            return redirect()->route('login')->with('error', 'User not found.');
        }

        // Check if the submitted OTP matches the one stored in the user's record
        if ($request->input('otp') == $user->otp) {
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
        } else {
            // OTP is incorrect, show an error message
            return redirect()->back()->with('error', 'OTP is incorrect.');
        }
    }

}
