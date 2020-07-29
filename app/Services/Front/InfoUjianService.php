<?php

namespace App\Services\Front;

use App\Classroom;
use App\ClassroomExam;
use Carbon\Carbon;

class InfoUjianService
{
    // Berikan info seputar ujian
    // Berikan info terkait peserta
    public $kelas;
    public $classexam;
    public $riwayat;
    public $ujian;
    public $totalSoal;
    public $pesan;
    public $allowed;

    public function __construct(Classroom $kelas, $slug)
    {
        $this->kelas = $kelas;

        $this->ujian = $kelas->exams()->where('slug', $slug)->first();

        $this->classexam = ClassroomExam::where([
                                                    ['classroom_id', $kelas->id],
                                                    ['exam_id', $this->ujian->id]
                                                ])->first();
        
        $this->riwayat = $this->classexam->users()->where('user_id', auth()->user()->id)->get()->last();

    }

    public function waktuMulai()
    {
        return new Carbon($this->riwayat->pivot->waktu_mulai);
    }

    public function waktuHabis()
    {
        if (!$this->riwayat->pivot->waktu_mulai) {
            return null;
        } else {
            $waktuMulai = $this->waktuMulai();
            return $waktuMulai->addMinutes($this->classexam->durasi);
        }

    }

    public function isAttemptAllowed() 
    {
        // Berapa kali percobaan yang diizinkan oleh ujian ini?
        $attemptAllowed = $this->classexam->attempt;

        // Kalau attempt == 0, artinya selalu allowed
        if ($attemptAllowed == 0) {
            return true;
        }

        // Riwayat User
        if ($this->riwayat) {
            $userAttempt = $this->riwayat->pivot->attempt;
        } else {
            $userAttempt = 0;
        }

        return ($userAttempt < $attemptAllowed) ? true : false;
    }

    public function isDone() 
    {
        // Belum mengerjakan
        if (!$this->riwayat) {
            return 'belum';
        }

        if (is_null($this->classexam->durasi) || $this->classexam->durasi == 0) {
            return null;
        }

        // Kalau sudah mengerjakan, periksa apakah sudah melebihi batas waktu atau belum
        $waktuMulai = $this->waktuMulai();
        
        $waktuHabis = $this->waktuHabis();

        if ($waktuHabis > Carbon::now()) {
            return 'sedang';
        } elseif ($waktuHabis < Carbon::now()) {
            return 'sudah';
        }

    }

    public function isAllowed()
    {
        // Sudah ngerjain?
        $ngerjain = $this->isDone();

        // Attempt masih ada?
        $attemptAllowed = $this->isAttemptAllowed();

        return ($ngerjain == 'sudah' && $attemptAllowed === false) ? false : true;
    }

    public function infoPage()
    {
        $this->totalSoal = $this->ujian->questions()->count();
        $this->allowed = $this->isAllowed();

        switch ($this->isDone()) {
            case 'sudah':
                $this->pesan = 'Anda sudah mengerjakan ujian ini';
                break;
        
            case 'sedang':
                $this->pesan = 'Anda sedang mengerjakan ujian ini';
                break;
            
            case 'belum':
                $this->pesan = 'Anda belum mengerjakan ujian ini';
                break;

            default:
                $this->pesan = null;
                break;
        }
    }

    public function init()
    {
        if ($this->isAllowed() === false) {
            return redirect(route('denied'));
        }

        $thisAttempt = $this->currentAttempt();

        // Kalau sedang ngerjain, arahkan langsung ke halaman soal pertama
        if ($this->isDone() == 'sedang') {
            return redirect(route('ujian.kerjain', [
                'kelas' => $this->kelas, 
                'slug' => $this->slug, 
                'soal' => $this->soalPertama()
            ]));
        }

        // Simpan data
        $this->classexam->users()->attach(auth()->user()->id, [
            'attempt' => 1, 
            'waktu_mulai' => Carbon::now()->toDateTimeString()
        ]);

        // Arahkan ke soal pertama
        return redirect(route('ujian.kerjain', [
            'kelas' => $this->kelas, 
            'slug' => $this->ujian->slug, 
            'soal' => $this->soalPertama()
        ]));
    }

    public function soalPertama()
    {
        return $this->ujian->questions()->first();
    }

    public function currentAttempt()
    {
        if (!$this->riwayat) {
            return 1;
        } elseif ($this->isAllowed()) {
            return $this->riwayat->pivot->attempt++;
        } 
    }

    public function submit()
    {
        
    }

}