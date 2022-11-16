<?php

namespace App\Libraries;
use Illuminate\Support\Facades\DB;

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
    public static function generateAgentAccount_number()
    {
        $sql = "select IFNULL( MAX(`account_code`)+ 1 , 101 ) as number from `agent`";   
        $data = DB::select($sql);
        $array = json_decode(json_encode($data), true);
        return $array[0]['number']; 
    }

    public static function generateAccount_number()
    {
        $sql = " select IFNULL( MAX(account_number)+ 1 , 101 ) as number from `tenant`";
        $data = DB::select($sql);
        $next = json_decode(json_encode($data), true);
        return $next[0]['number']; 
    }

}