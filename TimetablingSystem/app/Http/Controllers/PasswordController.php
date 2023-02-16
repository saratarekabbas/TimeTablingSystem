<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Facades\Auth;

class PasswordController extends Controller
{
    public function showForgotPasswordForm()
    {
        return view('forgot-password');
    }

    public function sendPasswordResetEmail(Request $request)
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

//    public function showPasswordResetForm(Request $request, $token = null)
//    {
//        return view('reset-password')->with(
//            ['token' => $token, 'email' => $request->email]
//        );
//    }

    public function showPasswordResetForm(Request $request, $token = null)
    {
        if ($request->isMethod('post')) {
            // Validate the request data
            $request->validate([
                'token' => 'required',
                'email' => 'required|email',
                'password' => 'required|confirmed|min:8',
            ]);

            // Reset the user's password
            $response = $this->broker()->reset(
                $request->only('email', 'password', 'password_confirmation', 'token'), function ($user, $password) {
                $user->password = bcrypt($password);
                $user->save();
                Auth::login($user);
            }
            );

            // Return the appropriate response based on the response from the password broker
            if ($response == Password::PASSWORD_RESET) {
                return redirect()->route('login');
            } else {
                return back()->withErrors(['email' => 'Failed to reset password.']);
            }
        }

        return view('reset-password')->with(
            ['token' => $token, 'email' => $request->email]
        );
    }




//    public function resetPassword(Request $request)
//    {
//        // Validate the request data
//        $request->validate([
//            'token' => 'required',
//            'email' => 'required|email',
//            'password' => 'required|confirmed|min:8',
//        ]);
//
//        // Define the password reset success route
//        $this->redirectTo = route('home');
//
//        // Reset the user's password
//        $response = $this->broker()->reset(
//            $request->only('email', 'password', 'password_confirmation', 'token'), function ($user, $password) {
//            $user->password = bcrypt($password);
//            $user->save();
//            Auth::login($user);
//        }
//        );
//
//        // Return the appropriate response based on the response from the password broker
//        if ($response == Password::PASSWORD_RESET) {
//            return redirect()->route('login');
//        } else {
//            return back()->withErrors(['email' => 'Failed to reset password.']);
//        }
//    }

//    public function resetPassword(Request $request, $token = null)
//    {
//        // Validate the request data
//        $request->validate([
//            'token' => 'required',
//            'email' => 'required|email',
//            'password' => 'required|confirmed|min:8',
//        ]);
//
//        // Reset the user's password
//        $response = $this->broker()->reset(
//            $request->only('email', 'password', 'password_confirmation', 'token'), function ($user, $password) {
//            $user->password = bcrypt($password);
//            $user->save();
//            Auth::login($user);
//        }
//        );
//
//        // Return the appropriate response based on the response from the password broker
//        if ($response == Password::PASSWORD_RESET) {
////            return redirect()->route('login');
//            // Define the password reset success route
//            $this->redirectTo = route('login');
//
//        } else {
//            return back()->withErrors(['email' => 'Failed to reset password.']);
//        }
//    }

//    public function resetPassword(Request $request)
//    {
//        // Validate the request data
//        $request->validate([
//            'token' => 'required',
//            'email' => 'required|email',
//            'password' => 'required|confirmed|min:8|max:16|alpha_num',
//        ]);
//
//        // Get the user with the provided email
//        $user = User::where('email', $request->email)->first();
//        $email = $user->email;
//        $password = $user->password;
//        $confirm_password = $user->password_confirmation;
//
//        if($password == $confirm_password){
//        User::where('email', '=', $email)->update([
//            'password' => $password,
//
////            'password' => bcrypt($request->input('password')),
//        ]);}
//
//        return redirect('/login')->with('message', 'You have changed your password successfully.');
//
//        // Check if the user exists
//
////        if ($user) {
////            // Update the user's password
////            $user->password = bcrypt($request->password);
////            $user->save();
////
////            // Log the user in
////            Auth::login($user);
////
////            // Redirect the user to the login page
////            return redirect()->route('login');
////        } else {
////            // Return an error if the user does not exist
////            return back()->withErrors(['email' => 'Email address not found.']);
////        }
//    }

    public function resetPassword(Request $request)
    {
        // Validate the request data
        $request->validate([
            'token' => 'required',
            'email' => 'required|email',
            'password' => 'required|confirmed|min:8|max:16|alpha_num',
        ]);

        // Get the user with the provided email
        $user = User::where('email', $request->email)->first();
        $email = $user->email;
        $password = $request->input('password');
        $confirm_password = $request->input('password_confirmation');

        if($password == $confirm_password){
            User::where('email', '=', $email)->update([
                'password' => bcrypt($password),
            ]);
        }

        return redirect('/login')->with('message', 'You have changed your password successfully.');
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
