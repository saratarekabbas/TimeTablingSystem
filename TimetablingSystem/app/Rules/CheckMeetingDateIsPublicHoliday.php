<?php
//
//namespace App\Rules;
//
//use App\Models\PublicHoliday;
//use Validator;
//
//Validator::extend('not_public_holiday', function($attribute, $value, $parameters, $validator) {
//$publicHolidays = PublicHoliday::all();
//
//foreach ($publicHolidays as $publicHoliday) {
//$publicHolidayStart = Carbon::parse($publicHoliday->public_holiday_start_date);
//$publicHolidayEnd = Carbon::parse($publicHoliday->public_holiday_end_date);
//$meetingDate = Carbon::parse($value);
//
//if ($meetingDate->between($publicHolidayStart, $publicHolidayEnd)) {
//return false;
//}
//}
//
//return true;
//});
//
//Validator::replacer('not_public_holiday', function($message, $attribute, $rule, $parameters) {
//return "{$attribute} cannot be selected because it is a public holiday.";
//});
