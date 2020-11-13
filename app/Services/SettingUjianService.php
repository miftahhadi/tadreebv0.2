<?php

namespace App\Services;

use Carbon\Carbon;

class SettingUjianService
{
    public static function bongkarWaktu($waktu)
    {

        if (!is_null($waktu)) {

            $waktu = new Carbon($waktu, '+07:00');
            $result['tanggal'] = $waktu->toDateString();
            $result['waktu'] = $waktu->format('h:i');
    
        } else {
            $result = null;
        }

        return $result;
    }
}