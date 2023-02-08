<?php
//
//namespace App\Providers;
//
//use Illuminate\Support\ServiceProvider;
//
//use App\Models\PublicHoliday;
//use Illuminate\Support\Facades\Validator;
//use Carbon\Carbon;
//
//class ValidationServiceProvider extends ServiceProvider
//{
//    public function boot()
//    {
//        Validator::extend('not_public_holiday', function ($attribute, $value, $parameters, $validator) {
//            $publicHolidays = PublicHoliday::all();
//
//            foreach ($publicHolidays as $publicHoliday) {
//                $publicHolidayStart = Carbon::parse($publicHoliday->public_holiday_start_date);
//                $publicHolidayEnd = Carbon::parse($publicHoliday->public_holiday_end_date);
//                $meetingDate = Carbon::parse($value);
//
//                if ($meetingDate->between($publicHolidayStart, $publicHolidayEnd)) {
//                    return false;
//                }
//            }
//
//            return true;
//        });
//
//        Validator::replacer('not_public_holiday', function ($message, $attribute, $rule, $parameters) {
//            return "{$attribute} cannot be selected because it is a public holiday.";
//        });
//    }
//}
