<?php

namespace App\Services\Front;

use App\Classroom;
use App\Exam;
use App\Question;
use App\ClassroomExam;
use Carbon\Carbon;

class InfoUjianService
{
    // Berikan info seputar ujian
    // Berikan info terkait peserta
    private $kelas;
    private $ujian;
    private $classexam;
    private $riwayat;
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
            $userAttempt = $riwayat->pivot->attempt;
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
        $waktuMulai = new Carbon($riwayat->pivot->waktu_mulai);
        $waktuHabis = 0;
        
        $waktuHabis = $waktuMulai->addMinutes($this->classexam->durasi);

        if ($waktuHabis == 0 || $waktuHabis > Carbon::now()) {
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

}