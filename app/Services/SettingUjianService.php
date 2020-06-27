<?php

namespace App\Services;

use Carbon\Carbon;

class SettingUjianService
{
    public static function bongkarWaktu($waktu)
    {

        if (!is_null($waktu)) {

            $waktu = new Carbon($waktu);
            $result['tanggal'] = $waktu->toDateString();
            $result['waktu'] = $waktu->format('h:i');
    
        } else {
            $result = null;
        }

        return $result;
    }
}