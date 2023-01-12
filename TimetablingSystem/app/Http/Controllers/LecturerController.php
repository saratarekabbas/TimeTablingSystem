<?php

namespace App\Http\Controllers;

use App\Mail\RegistrationApprovedMail;
use App\Mail\RegistrationDisapprovedMail;
use App\Models\Lecturer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class LecturerController extends Controller
{
    public function index()
    {
        $data = Lecturer::where('lecturer_registration_status', '=', 'pending')->get();
        return view('/office-assistant/user-application/user-application-list', compact('data'));
    }

    public function approveRegistrationRequest($id)
    {
//        Update the lecturer's status in database
        Lecturer::where('id', '=', $id)->update([
            'lecturer_registration_status' => 'approved'
        ]);

//      Send Approval email to this lecturer's email
        $lecturerData = Lecturer::where('id', '=', $id)->first();
        $lecturerEmail = $lecturerData->lecturer_email;
        Mail::to($lecturerEmail)->send(new RegistrationApprovedMail());

        return redirect()->back()->with('success', 'Successful: Registration request has been approved successfully');
    }

    public function disapproveRegistrationRequest($id)
    {
//        Update the lecturer's status in database
        Lecturer::where('id', '=', $id)->update([
            'lecturer_registration_status' => 'disapproved'
        ]);

//      Send Disapproval email to this lecturer's email
        $lecturerData = Lecturer::where('id', '=', $id)->first();
        $lecturerEmail = $lecturerData->lecturer_email;
        Mail::to($lecturerEmail)->send(new RegistrationDisapprovedMail());

        return redirect()->back()->with('success', 'Successful: Registration request has been disapproved successfully');
    }
}
