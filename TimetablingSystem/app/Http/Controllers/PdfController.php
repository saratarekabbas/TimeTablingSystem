<?php

namespace App\Http\Controllers;

use App\Models\Timetable;
use Illuminate\Http\Request;

class PdfController extends Controller
{
    public function index(){
        $timetable = Timetable::all();
    }
}
