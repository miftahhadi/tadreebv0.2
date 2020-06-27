<?php

namespace App\Services;

use Carbon\Carbon;

class SaveSettingUjianService
{
    public static function setWaktu($tanggal, $waktu)
    {
        if ($tanggal != null) {
            $result = $tanggal . ' ' . $waktu;

            $result = new Carbon($tanggal);
        } else {
            $result = null;
        }

        return $result;
    }
}