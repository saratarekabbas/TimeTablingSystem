<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class AuthController extends Controller
{
    /**
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */

//    Lecturer Registration
    public function registration(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:8|max:16|alpha_num'
        ]);

        $validatedData['role'] = 'lecturer';
        $validatedData['lecturer_registration_status'] = 'pending';
        $user = User::create(
            [
                'name' => $request->input('name'),
                'email' => $request->input('email'),
                'password' => bcrypt($request->input('password')),
                'lecturer_registration_status' => $validatedData['lecturer_registration_status']
            ]
        );

        $user->assignRole('lecturer');

        return redirect()->back()->with('success', 'Your Registration Request Has Been Submitted Successfully!');
    }

    /**
     * Login user
     *
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        $credentials = request(['email', 'password']);
        $user = User::where('email', $request->email)->first();

        if (!$user) {
            return redirect()->back()->with('error', 'Invalid Email and/or Password. Please, make sure you have inserted the correct credentials.');
        }

        if ($user->login_attempts >= 3) {
            return redirect()->back()->with('error', 'Error: Invalid Password Attempts Exceeded. Please Reset Your Password');
        }

        if (!Auth::attempt($credentials)) {
            $user->login_attempts = $user->login_attempts + 1;
            $user->save();
            return redirect()->back()->with('error', 'Invalid Email and/or Password. Please, make sure you have inserted the correct credentials.');
        }

        $user->login_attempts = 0;
        $user->save();

        if ($user->hasRole('lecturer')) {
            if ($user->lecturer_registration_status == 'pending') {
                return redirect()->back()->with('error', 'Sorry, your registration request is still pending.');
            } else if ($user->lecturer_registration_status == 'disapproved') {
                return redirect()->back()->with('error', 'Sorry, your registration request has been disapproved. Please, contact the Office for more assistance.');
            } else if ($user->lecturer_registration_status == 'approved') {
                return redirect()->route('lecturer.overview')->with('success', 'Welcome, You are now logged in!');
            }
        }elseif ($user->hasRole('office_assistant')) {
            return redirect()->route('office_assistant.overview')->with('success', 'Welcome, You are now logged in!');
        } else {
            Auth::logout();
            return redirect()->back()->with('error', 'You do not have a role assigned. Please contact the Office for more assistance.');
        }
    }


    public function logout()
    {
        Auth::logout();
        return redirect('/login')->with('message', 'You have successfully logged out.')->withInput()->header('Cache-Control','no-cache, no-store, must-revalidate');
    }


}
