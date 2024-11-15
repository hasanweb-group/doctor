<?php

namespace App\Helpers;

use Carbon\Carbon;

class CarbonHelper
{
    public static function dateTimeFormat($date)
    {
        if ($date == null) {
            return null;
        }

        return Carbon::parse($date)->format('Y-m-d H:i:s');
    }

    public static function dateTimeFormatArabic($date)
    {

        $formatedDate =  Carbon::parse($date)->format('Y-m-d h:i:s A');
        return str_replace(['AM', 'PM'], ['صباحًا', 'مساءً'], $formatedDate);
    }
}
