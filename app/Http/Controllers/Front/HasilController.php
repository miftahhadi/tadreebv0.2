<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Classroom;
use App\Exam;
use App\ClassroomExam;
use App\ClassExamUser;
use App\User;
use App\Services\Front\HasilUjianService;
use Illuminate\Database\Eloquent\Builder;

class HasilController extends Controller
{
    public function showAll(Classroom $kelas, $slug)
    {
        $exam = $kelas->exams()->where('slug', $slug)->first();

        // Ambil semua peserta kelas ini
        $students = $kelas->users()->with('classroomexams')->get();

        // Ambil data dari classroomexam_user
        $userDidExam = (new HasilUjianService($exam->pivot->id))->whoDidExam()->pluck('id')->toArray();

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

        $nilaiAll = $hasil->nilaiUserAll($exam->id);

        return view('front.classroom.hasil-done',[
            'title' => 'Sudah Mengerjakan | Hasil Ujian | ' . $exam->judul,
            'exam' => $exam,
            'kelas' => $kelas,
            'nilaiAll' => $nilaiAll
        ]);

    }

    public function detail(Classroom $kelas, $slug, User $user)
    {
        // User boleh buka halaman ini?
        if (auth()->user()->id != $user->id) {
            if (!auth()->user()->isAdmin() && !auth()->user()->isTeacher()) {
                return redirect(route('ujian.hasil.detail', ['kelas' => $kelas->id, 'slug' => $slug, 'user' => auth()->user()->id]));
            } 
        }

        // Ambil object exam
        $exam = $kelas->exams()->where('slug', $slug)->first();

        // Setting kunci dibuka atau tidak
        if (auth()->user()->isAdmin() || auth()->user()->isTeacher()) {
            $bukaKunci = 1;
        } else {
            $bukaKunci = $exam->pivot->buka_hasil;
        }

        // Data user
        $dataSubmit = $user->classroomexams()->where('classroom_exam_id', $exam->pivot->id)->get()->last();

        // Load soal dan jawaban
        $exam->load('questions.answers');

        // Jumlah soal
        $jumlahSoal = $exam->questions->count();

        $hasil = new HasilUjianService($exam->pivot->id);

        // Jawaban User
        $jawabanUser = $hasil->jawabanUserArray($user, $exam);

        $nilaiUser = $hasil->nilaiUser($user);

        $nilaiUjian = $hasil->nilaiUjian($exam);

        $choice = $hasil->inputTypeMass($exam);

        return view('front.classroom.hasil-detail', [
            'title' => 'Lembar Jawaban Peserta | ' . $exam->judul,
            'exam' => $exam,
            'user' => $user,
            'bukaKunci' => $bukaKunci,
            'jumlahSoal' => $jumlahSoal,
            'choice' => $choice,
            'dataSubmit' => $dataSubmit,
            'jawabanUser' => $jawabanUser,
            'nilaiUser' => $nilaiUser,
            'nilaiUjian' => $nilaiUjian
        ]);
    }
}
