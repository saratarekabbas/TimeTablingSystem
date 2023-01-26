<?php

namespace App\Rules;

use App\Http\Controllers\TimetableController;
use App\Models\PublicHoliday;
use App\Models\Timetable;
use Illuminate\Contracts\Validation\Rule;
use PhpParser\Node\Expr\Cast\Bool_;

class PublicHolidayOverlapWithMeeting implements Rule
{
    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Determine if the validation rule passes.
     *
     * @param string $attribute
     * @param mixed $value
     * @return bool
     */
    public function passes($attribute, $value)
    {
//        $value is the inserted date

        $allpublicholidays = PublicHoliday::all();
        $publicholidayslist[] = array();
        $i = 0;
        foreach ($allpublicholidays as $allpublicholiday) {

            $publicholidaystart = $allpublicholiday->public_holiday_start_date;
            $publicholidayend = $allpublicholiday->public_holiday_end_date;

            $publicholidayslist[] = [
                $i => $publicholidaystart,
            ];

            if ($publicholidaystart != $publicholidayend) {
                while ($publicholidaystart <= $publicholidayend) {
                    $publicholidaystart = $publicholidaystart->addDays(1);
                    $publicholidayslist[] = [
                        $i++ => $publicholidaystart
                    ];
                }
            }
        }

        $error = FALSE;

        foreach ($publicholidays as $publicholiday) {

        }


        return $error;
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'The validation error message.';
    }
}
