<?php

use App\Http\Controllers\CourseController;
use App\Http\Controllers\LecturerController;
use App\Http\Controllers\PdfController;
use App\Http\Controllers\TimetableController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PublicHolidayController;
use App\Http\Controllers\ProgramController;
use App\Http\Controllers\VenueController;
use App\Http\Controllers\AuthController;


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

//|--------------------------------------------------------------------------
//|                                  GENERAL
//|--------------------------------------------------------------------------

//----------------------------------------------------------------------------//
// 1. Registration
//----------------------------------------------------------------------------//

Route::get('/registration', function () {
    return view('registration');
});
Route::post('/registration', [AuthController::class, 'registration']);

//----------------------------------------------------------------------------//
// 2. Login
//----------------------------------------------------------------------------//
Route::get('/login', function () {
    return view('login');
});
Route::post('/login', [AuthController::class, 'login']);


//----------------------------------------------------------------------------//
// 3. Email
//----------------------------------------------------------------------------//

//Route for mailing: Registration Approved Email
Route::get('/registration-approved/{id}', [LecturerController::class, 'approveRegistrationRequest']);

//Route for mailing: Registration Disapproved Email
Route::get('/registration-disapproved/{id}', [LecturerController::class, 'disapproveRegistrationRequest']);

//----------------------------------------------------------------------------//
// 4. Forgot Password & Reset Password
//----------------------------------------------------------------------------//

Route::get('/forgot-password', function () {
    return view('/forgot-password');
});

Route::get('/reset-password', function () {
    return view('/reset-password');
});


//----------------------------------------------------------------------------//
// 4. Other
//----------------------------------------------------------------------------//

Route::get('/', function () { //you need to change this later to make it go directly to the login page
    return view('login');
});

//Route::post('logout', 'AuthController@logout')->name('logout');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');





//|--------------------------------------------------------------------------
//|                               OFFICE ASSISTANT
//|--------------------------------------------------------------------------

//----------------------------------------------------------------------------//
// 1. Overview
//----------------------------------------------------------------------------//

//Route::get('/office-assistant/overview', function () {
//    return view('/office-assistant/overview');
//});

Route::get('/office-assistant/overview', function () {
    return view('/office-assistant/overview');
})->name('office_assistant.overview');

//Route::get('/office_assistant/overview', [AuthController::class, 'overview'])->name('office_assistant.overview');


//----------------------------------------------------------------------------//
// 2. User Application Routings
//----------------------------------------------------------------------------//

//displays all list of public holidays
Route::get('/office-assistant/user-application/user-application-list', [LecturerController::class, 'index']);
//Approve User Registration Request
Route::get('/office-assistant/user-application/approve-user-application/{id}', [LecturerController::class, 'approveRegistrationRequest']);
//disapprove User Registration Request
Route::get('/office-assistant/user-application/disapprove-user-application/{id}', [LecturerController::class, 'disapproveRegistrationRequest']);


//----------------------------------------------------------------------------//
// 3. Public Holiday Routings
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
// 4. Programs Routings
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
// 5. Venue Routings
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
// 6. Course Routings
//----------------------------------------------------------------------------//

//displays all list of programs
Route::get('/office-assistant/course/course-list', [CourseController::class, 'index']);
//Filter course by program
Route::get('/office-assistant/course/course-list/{id}', [CourseController::class, 'filterProgram']);
//Add a program
Route::get('/office-assistant/course/add-course', [CourseController::class, 'addCourse']);
//Save program (Add)S
Route::post('/office-assistant/course/save-course', [CourseController::class, 'saveCourse']);
//Edit program
Route::get('/office-assistant/course/edit-course/{id}', [CourseController::class, 'editCourse']);
//Edit program (Update)
Route::post('/office-assistant/course/update-course', [CourseController::class, 'updateCourse']);
//Delete program
Route::get('/office-assistant/course/delete-course/{id}', [CourseController::class, 'deleteCourse']);


//----------------------------------------------------------------------------//
// 7. Timetable Routings
//----------------------------------------------------------------------------//

//displays all list of all timetable entities
Route::get('/office-assistant/timetable/timetable-list', [TimetableController::class, 'index']);
//Filter timetable entities by program
Route::get('/office-assistant/timetable/timetable-list/{id}', [TimetableController::class, 'filterProgram']);
//Add a timetable entity
Route::get('/office-assistant/timetable/add-timetable', [TimetableController::class, 'addTimetable']);
//Save timetable entity (Add)
Route::post('/office-assistant/timetable/save-timetable', [TimetableController::class, 'saveTimetable']);
//Edit timetable entity
Route::get('/office-assistant/timetable/edit-timetable/{id}', [TimetableController::class, 'editTimetable']);
//Edit timetable entity (Update)
Route::post('/office-assistant/timetable/update-timetable', [TimetableController::class, 'updateTimetable']);
// Add timetable slots
Route::get('/office-assistant/timetable/add-timetable-slot/{id}', [TimetableController::class, 'addTimetableSlot']);
//Save timetable slots (Add)
Route::post('/office-assistant/timetable/save-timetable-slot', [TimetableController::class, 'saveTimetableSlot']);
//Edit timetable slot
Route::get('/office-assistant/timetable/edit-timetable-slot/{id}', [TimetableController::class, 'editTimetableSlot']);
//Edit timetable entity (Update)
Route::post('/office-assistant/timetable/update-timetable-slot', [TimetableController::class, 'updateTimetableSlot']);
//Delete timetable entity
Route::get('/office-assistant/timetable/delete-timetable/{id}', [TimetableController::class, 'deleteTimetable']);
//Delete timetable slots

//displays the calendar
Route::get('/office-assistant/timetable/calendar-view/view-calendar', [TimetableController::class, 'calendarIndex']);
//Filter calendar by program
Route::get('/office-assistant/timetable/calendar-view/view-calendar/{id}', [TimetableController::class, 'filterCalendar']);

//Print All Timetable Entities
Route::get('/office-assistant/timetable/print-timetable/export', [TimetableController::class, 'exportAll']);
//Print for a Specific Program
Route::get('/office-assistant/timetable/print-timetable/export/{id}', [TimetableController::class, 'export']);


//|--------------------------------------------------------------------------
//|                                  LECTURER
//|--------------------------------------------------------------------------

//----------------------------------------------------------------------------//
// 1. Overview
//----------------------------------------------------------------------------//

//Route::get('/lecturer/overview', function () {
//    return view('/lecturer/overview');
//});

Route::get('/lecturer/overview', function () {
    return view('/lecturer/overview');
})->name('lecturer.overview');

//Route::get('/lecturer/overview', [AuthController::class, 'overview'])->name('lecturer.overview');
