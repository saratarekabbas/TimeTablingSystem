<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Controllers\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Password;


class ResetPasswordController extends Controller
{
    public function showForgotPasswordForm()
    {
        return view('/forgot-password');
    }


//reset email
    public function sendResetPasswordEmail(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
        ]);

        $response = Password::sendResetLink($request->only('email'));

        if ($response == Password::RESET_LINK_SENT) {
            return redirect()->back()->with('success', 'Password reset link sent. Please check your email.');
        } else {
            return redirect()->back()->with('error', 'Failed to send password reset link. Please try again.');
        }
    }

    public function showResetPasswordForm($token)
    {
        return view('reset-password', ['token' => $token]);
    }

    public function resetPassword(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required|min:8|max:16|alpha_num|confirmed',
        ]);

        $user = User::where('email', $request->email)->first();
        if (!$user) {
            return redirect()->back()->with('error', 'Sorry, this email address is not registered in our system.');
        }

        $user->password = bcrypt($request->password);
        $user->save();

        return redirect()->route('login')->with('success', 'Password reset successful, please login with your new password.');
    }
}
