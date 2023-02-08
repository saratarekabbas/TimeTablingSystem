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

//        return response()->json([
//            'message' => 'Your Registration Request Has Been Submitted Successfully!',
//            'user' => $user
//        ], 201);
    }


//Login user
    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required|min:8'
        ]);

        $user = User::where('email', $request->email)->first();

//        Invalid user
        if (!$user) {
            return response()->json([
                'message' => 'Invalid Email and/or Password. Please, make sure you have inserted the correct credentials.'
            ], 401);
        }

//        Invalid password
        if (!Hash::check($request->password, $user->password)) {
            return response()->json([
                'message' => 'Invalid Email and/or Password. Please, make sure you have inserted the correct credentials.'
            ], 401);
        }


        if (!Auth::attempt($credentials)) {
            return response()->json([
                'message' => 'Unauthorized'
            ], 401);
        }

        if ($user->hasRole('lecturer')) {
            if ($user->lecturer_registration_status === 'pending') {
                return response()->json([
                    'message' => 'Sorry, your registration request is still pending.'
                ], 401);
            } elseif ($user->lecturer_registration_status === 'disapproved') {
                return response()->json([
                    'message' => 'Sorry, your registration request has been denied. Please, contact the Office for more assistance.'
                ], 401);
            } else {

                return redirect()->route('/lecturer/overview');
            }
        } else if ($user->role === 'office_assistant') {
            return redirect()->route('/office-assistant/overview');
        }

        $token = $user->createToken('authToken')->accessToken;

        return response()->json([
            'user' => $user,
            'token' => $token
            ], 200);
    }
}
