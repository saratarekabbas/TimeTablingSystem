<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PublicHolidayController;

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

//displays all list of public holidays
Route::get('/office-assistant/public-holiday/public-holiday-list', [PublicHolidayController::class, 'index']);

//Add a public holiday
Route::get('/office-assistant/public-holiday/add-public-holiday', [PublicHolidayController::class, 'addPublicHoliday']);

//Save public holiday (Add)
Route::post('/office-assistant/public-holiday/save-public-holiday', [PublicHolidayController::class, 'savePublicHoliday']);

//Edit public holiday
Route::get('/office-assistant/public-holiday/edit-public-holiday/{id}', [PublicHolidayController::class, 'editPublicHoliday']);

//Edit public holiday (Update)
Route::post('/office-assistant/public-holiday/update-public-holiday', [PublicHolidayController::class, 'updatePublicHoliday']);
