<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PublicHolidayController;
use App\Http\Controllers\VenueController;


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
