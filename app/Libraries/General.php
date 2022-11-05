<?php

namespace App\Libraries;

class General
{
    public static function calculateMin2Sec($min)
    {
        if($min == 0)
        {
            return 0;
        }
        else
        {
            return $min * 60;
        }
    }
    public static function calculateSec2Min($sec)
    {
        if($sec == 0)
        {
            return 0;
        }
        else
        {
            return $sec / 60;
        }
    }

}