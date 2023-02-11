<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
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


//Login user
//    public function login(Request $request)
//    {
//        $credentials = $request->validate([
//            'email' => 'required|email',
//            'password' => 'required|min:8'
//        ]);
//
//        $user = User::where('email', $request->email)->first();
//
////        Invalid user
//        if (!$user) {
////            return response()->json([
////                'message' => 'Invalid Email and/or Password. Please, make sure you have inserted the correct credentials.'
////            ], 401);
//            $message = 'Invalid Email and/or Password. Please, make sure you have inserted the correct credentials.';
//            return view('login', compact('message'));
//        }
//
////        Invalid password
//        if (!Hash::check($request->password, $user->password)) {
////            return response()->json([
////                'message' => 'Invalid Email and/or Password. Please, make sure you have inserted the correct credentials.'
////            ], 401);
//            $message = 'Invalid Email and/or Password. Please, make sure you have inserted the correct credentials.';
//            return view('login', compact('message'));
//        }
//
//        if (!Auth::attempt($credentials)) {
//            dd($request->email, $request->password);
////            return response()->json([
////                'message' => 'Invalid Email and/or Password. Please, make sure you have inserted the correct credentials.'
////            ], 401);
//            $message = 'Invalid Email and/or Password. Please, make sure you have inserted the correct credentials.';
//            return view('login', compact('message'));
//
//        }
//
//        if ($user->hasRole('lecturer')) {
//            if ($user->lecturer_registration_status === 'pending') {
////                return response()->json([
////                    'message' => 'Sorry, your registration request is still pending.'
////                ], 401);
//                $message = 'Sorry, your registration request is still pending.';
//                return view('login', compact('message'));
//            } elseif ($user->lecturer_registration_status === 'disapproved') {
////                return response()->json([
//////                    'message' => 'Sorry, your registration request has been denied. Please, contact the Office for more assistance.'
//////                ], 401);
//                $message = 'Sorry, your registration request has been denied. Please, contact the Office for more assistance.';
//                return view('login', compact('message'));
//            } else {
//                return redirect()->route('lecturer.overview');
//            }
//        } else if ($user->role === 'office_assistant') {
//            return redirect()->route('office_assistant.overview');
//        }
//
//        session_start();
//        $_SESSION['success'] = 'Login successful';
//
//
//        $token = $user->createToken('authToken')->accessToken;
//
//        return response()->json([
//            'user' => $user,
//            'token' => $token
//        ], 200);
//    }



    public function login(Request $request)
    {
        $validatedData = $request->validate([
            'email' => 'required|email',
            'password' => 'required|min:6',
        ]);

        if (Auth::attempt(['email' => $validatedData['email'], 'password' => $validatedData['password']])) {
            $user = Auth::user();
            if ($user->role === 'office_assistant') {
                return redirect()->route('office_assistant.overview')->with('success', 'You have successfully logged in OA!');
            } else if ($user->role === 'lecturer') {
                return redirect()->route('lecturer.overview')->with('success', 'You have successfully logged in LC!');
            }
        }

        return redirect()->back()->with('error', 'Email or password is incorrect.');
    }




}
