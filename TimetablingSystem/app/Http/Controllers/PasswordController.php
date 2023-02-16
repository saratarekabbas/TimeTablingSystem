<?php

namespace App\Http\Controllers;

use App\Mail\ResetPasswordMail;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Facades\Auth;


class PasswordController extends Controller
{
    public function forgotPassword(Request $request)
    {
        // Validate the request data
        $request->validate([
            'email' => 'required|email',
        ]);

        // Send the password reset link to the user
        $response = $this->broker()->sendResetLink(
            $request->only('email')
        );

        // Return the appropriate response based on the response from the password broker
        if ($response == Password::RESET_LINK_SENT) {
            return back()->with('status', 'Password reset link sent to your email address.');
        } else {
            return back()->withErrors(['email' => 'Email address not found.']);
        }
    }

    public function resetPassword(Request $request)
    {
        // Validate the request data
        $request->validate([
            'token' => 'required',
            'email' => 'required|email',
            'password' => 'required|confirmed|min:8',
        ]);

        // Reset the user's password
        Mail::to($request->email)->send(new ResetPasswordMail());

        $response = $this->broker()->reset(
            $request->only('email', 'password', 'password_confirmation', 'token'), function ($user, $password) {
            $user->password = bcrypt($password);
            $user->save();
            Auth::login($user);
        }
        );

        // Return the appropriate response based on the response from the password broker
        if ($response == Password::PASSWORD_RESET) {
            return redirect()->route('home');
        } else {
            return back()->withErrors(['email' => 'Failed to reset password.']);
        }
    }

    /**
     * Get the password broker instance.
     *
     * @return \Illuminate\Contracts\Auth\PasswordBroker
     */
    public function broker()
    {
        return Password::broker();
    }
}
