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
}
