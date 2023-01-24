<?php

namespace App\Http\Controllers;

use App\Models\Timetable;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;

class PdfController extends Controller
{
//    public function index()
//    {
//        $timetable = Timetable::all();
//
//        return view('/office-assistant/timetable/calendar-view/print-calendar', compact('timetable'));
//    }

//    public function export()
//    {
//        $timetable = Timetable::all();
//
//        $pdf = Pdf::LoadView('print-calendar', compact('timetable'));
//        return $pdf->download('timetable.pdf');
//    }
}
