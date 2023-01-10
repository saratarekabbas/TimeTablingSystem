<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

//Route::get('/', function () {
//    return view('welcome');
//});


Route::get('/', function () {
    return view('/office-assistant/user-application/userApplications');
});

//Route::get('publicHoliday', function () {
//    return view('/office-assistant/public-holiday/publicHoliday');
//});

Route::get('publicHoliday', function (){
    return view('/office-assistant/public-holiday/publicHoliday', [
       'publicHoliday' => '<h1> Hello World</h1>'
    ]);
});
