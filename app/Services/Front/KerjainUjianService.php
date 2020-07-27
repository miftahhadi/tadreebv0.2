<?php

namespace App\Services\Front;

class KerjainUjianService extends InfoUjianService
{
    public function kerjainUjian()
    {
        // Kalau belum pernah ngerjain, arahkan ke halaman info
        if (!$this->riwayat) {
            return redirect(route('ujian.info', ['kelas' => $kelas, 'slug' => $slug]));
        }
    }

    public function cekWaktuMulai()
    {
        // Cek dari cookie ada atau gak
        // kalau gak ada, ambil dari database dan simpan ke cookie
        if ($_COOKIE['waktu_mulai']) {
            return $_COOKIE['waktu_mulai'];
        } else {
            $start = $this->riwayat->pivot->waktu_mulai;
            setcookie($waktu_mulai, $start, time() + (86400 * 30), "/");

            return $start;
        }
    }

    public function setWaktuMulai($waktuMulai)
    {
        return new Carbon($waktuMulai);        
    }
}