<?php

use Illuminate\Support\Facades\Route;
//use App\Http\Controllers\UserApplicationController;
use App\Http\Controllers\PublicHolidayController;
use App\Http\Controllers\ProgramController;
use App\Http\Controllers\VenueController;
//use App\Http\Controllers\CourseController;
//use App\Http\Controllers\TimetableController;


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

//|--------------------------------------------------------------------------
//|                               OFFICE ASSISTANT
//|--------------------------------------------------------------------------

//----------------------------------------------------------------------------//
// 1. User Application Routings
//----------------------------------------------------------------------------//


//----------------------------------------------------------------------------//
// 2. Public Holiday Routings
//----------------------------------------------------------------------------//

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
//Delete public holiday
Route::get('/office-assistant/public-holiday/delete-public-holiday/{id}', [PublicHolidayController::class, 'deletePublicHoliday']);


//----------------------------------------------------------------------------//
// 3. Programs Routings
//----------------------------------------------------------------------------//

//displays all list of programs
Route::get('/office-assistant/program/program-list', [ProgramController::class, 'index']);
//Add a program
Route::get('/office-assistant/program/add-program', [ProgramController::class, 'addProgram']);
//Save program (Add)
Route::post('/office-assistant/program/save-program', [ProgramController::class, 'saveProgram']);
//Edit program
Route::get('/office-assistant/program/edit-program/{id}', [ProgramController::class, 'editProgram']);
//Edit program (Update)
Route::post('/office-assistant/program/update-program', [ProgramController::class, 'updateProgram']);
//Delete program
Route::get('/office-assistant/program/delete-program/{id}', [ProgramController::class, 'deleteProgram']);


//----------------------------------------------------------------------------//
// 4. Venue Routings
//----------------------------------------------------------------------------//

//displays all list of venues
Route::get('/office-assistant/venue/venue-list', [VenueController::class, 'index']);
//Add a venues
Route::get('/office-assistant/venue/add-venue', [VenueController::class, 'addVenue']);
//Save venues (Add)
Route::post('/office-assistant/venue/save-venue', [VenueController::class, 'saveVenue']);
//Edit venues
Route::get('/office-assistant/venue/edit-venue/{id}', [VenueController::class, 'editVenue']);
//Edit venues (Update)
Route::post('/office-assistant/venue/update-venue', [VenueController::class, 'updateVenue']);
//Delete venue
Route::get('/office-assistant/venue/delete-venue/{id}', [VenueController::class, 'deleteVenue']);


//----------------------------------------------------------------------------//
// 5. Course Routings
//----------------------------------------------------------------------------//


//----------------------------------------------------------------------------//
// 6. Timetable Routings
//----------------------------------------------------------------------------//
