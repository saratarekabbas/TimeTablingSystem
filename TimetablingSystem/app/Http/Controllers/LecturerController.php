<?php

namespace App\Http\Controllers;

use App\Models\Lecturer;
use Illuminate\Http\Request;

class LecturerController extends Controller
{
    public function index()
    { //fetch all records and display lists
        $data = Lecturer::get();
        //compact is to pass $data basically
        return view('/office-assistant/user-application/user-application-list', compact('data'));
    }

    public function approveRegistrationRequest($id)
    {
        Lecturer::where('id', '=', $id)->update([
            'lecturer_registration_status' => 'approved'
        ]);
        return redirect()->back()->with('success', 'Successful: Registration request has been approved successfully');
    }

    public function disapproveRegistrationRequest($id)
    {
        Lecturer::where('id', '=', $id)->update([
            'lecturer_registration_status' => 'disapproved'
        ]);
        return redirect()->back()->with('success', 'Successful: Registration request has been disapproved successfully');
    }
}
