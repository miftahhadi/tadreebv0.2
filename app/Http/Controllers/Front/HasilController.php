<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Classroom;
use App\Exam;
use App\ClassroomExam;
use App\ClassExamUser;
use App\Services\Front\HasilUjianService;

class HasilController extends Controller
{
    public function showAll(Classroom $kelas, $slug)
    {
        $exam = $kelas->exams()->where('slug', $slug)->first();

        // Ambil semua peserta kelas ini
        $students = $kelas->users()->with('classroomexams')->get();

        // Ambil data dari classroomexam_user
        $userDidExam = (new HasilUjianService($exam->pivot->id))->whoDidExam();

        return view('front.classroom.hasil', [
            'title' => 'Hasil Ujian | ' . $exam->judul,
            'kelas' => $kelas,
            'exam' => $exam,
            'students' => $students,
            'userDidExam' => $userDidExam
        ]);
    }

    public function showDone(Classroom $kelas, $slug)
    {
        // Ambil object exam
        $exam = $kelas->exams()->where('slug', $slug)->first();

        $hasil = new HasilUjianService($exam->pivot->id);

        $nilaiAll = $hasil->nilaiUser($exam->id);

        return view('front.classroom.hasil-done',[
            'title' => 'Sudah Mengerjakan | Hasil Ujian | ' . $exam->judul,
            'exam' => $exam,
            'kelas' => $kelas,
            'nilaiAll' => $nilaiAll
        ]);

    }
}
