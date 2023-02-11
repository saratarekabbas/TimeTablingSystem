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
                'role' => $validatedData['role'],
                'lecturer_registration_status' => $validatedData['lecturer_registration_status']
            ]
        );

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
            'password' => 'required|min:8|max:16|alpha_num',
        ]);

        $credentials = request(['email', 'password']);
        $user = User::where('email', $request->email)->first();

        if (!$user) {
            return redirect()->back()->with('error', 'Invalid Email and/or Password. Please, make sure you have inserted the correct credentials.');
        }

        if (!Auth::attempt($credentials)) {
            ////            Add this field 'login_attempts' to the DB
////            if ($user->login_attempts >= 2) {
////                return redirect()->back()->with('error', 'Error: Invalid Password Attempts Exceeded. Please Reset Your Password');
////            }
////
////            $user->login_attempts = $user->login_attempts + 1;
////            $user->save();
            return redirect()->back()->with('error', 'Invalid Email and/or Password. Please, make sure you have inserted the correct credentials.');
        }

        if ($user->role == 'lecturer') {
            if ($user->lecturer_registration_status == 'pending') {
                return redirect()->back()->with('error', 'Sorry, your registration request is still pending.');
            } else if ($user->lecturer_registration_status == 'denied') {
                return redirect()->back()->with('error', 'Sorry, your registration request has been denied. Please, contact the Office for more assistance.');
            } else if ($user->lecturer_registration_status == 'approved') {
                return redirect()->route('lecturer.overview')->with('success', 'Welcome, You are now logged in!');
            }
        }

        return redirect()->route('office_assistant.overview')->with('success', 'Welcome, You are now logged in!');
    }





}
