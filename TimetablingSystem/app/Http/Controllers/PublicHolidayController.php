<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\PublicHoliday;

class PublicHolidayController extends Controller
{
    public function index()
    { //fetch all records and display lists
        $data = PublicHoliday::get();
//        return $data;
        //compact is to pass $data basically
        return view('/office-assistant/public-holiday/public-holiday-list', compact('data'));
    }

    public function addPublicHoliday()
    {
        return view('/office-assistant/public-holiday/add-public-holiday');
    }

    public function savePublicHoliday(Request $request)
    {
//        Validation
        $request->validate([
            'public_holiday_title' => 'required',
            'public_holiday_start_date' => 'required|date|date_format:Y-m-d|before_or_equal:public_holiday_end_date',
            'public_holiday_end_date' => 'required|date|date_format:Y-m-d|after_or_equal:public_holiday_start_date'
        ]);

        $public_holiday_title = $request->public_holiday_title;
        $public_holiday_start_date = $request->public_holiday_start_date;
        $public_holiday_end_date = $request->public_holiday_end_date;

//        Create a model in our Eloquent Model PublicHoliday
        $publicholidaydata = new PublicHoliday();
        $publicholidaydata->public_holiday_title = $public_holiday_title;
        $publicholidaydata->public_holiday_start_date = $public_holiday_start_date;
        $publicholidaydata->public_holiday_end_date = $public_holiday_end_date;
        $publicholidaydata->save();

        return redirect()->back()->with('success', 'Successful: Public holiday have been created successfully');
    }
}
