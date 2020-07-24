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

    public function __construct(Classroom $kelas, $slug)
    {
        $this->kelas = $kelas;

        $this->ujian = $kelas->exams()->where('slug', $slug)->first();

        $this->classexam = ClassroomExam::where([
                                                ['classroom_id', $kelas->id],
                                                ['exam_id', $exam->id]
                                            ])->first();
    }

    // User sudah pernah ngerjain ujian?
    public function riwayatUjian() {
        return $this->classexam->users()->where('user_id', auth()->user()->id)->get()->last();
    }

}