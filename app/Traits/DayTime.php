<?php

namespace App\Traits;

trait DayTime
{
    public function dayTime()
    {
        if (date('h') + 7 >= 5 && date('h') + 7 <= 12) {
            return "pagi";
        } elseif (date('h') + 7 >= 13 && date('h') + 7 <= 14) {
            return "siang";
        } elseif (date('h') + 7 >= 15 && date('h') + 7 <= 18) {
            return "sore";
        } elseif (date('h') + 7 >= 19 && date('h') + 7 <= 4) {
            return "malam";
        }
    }
}
