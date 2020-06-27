<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Classroom;
use App\Exam;
use App\Question;
use App\ClassroomExam;
use Carbon\Carbon;

class ExamController extends Controller
{
    public function info(Classroom $kelas, $slug)
    {
        // $exam = $kelas->exams()->where('slug', $slug)->first();

        $exam = ClassroomExam::where('classroom_id', $kelas->id)->get();

        dd($exam);

        $soalPertama = $exam->questions()->first();

        return view('front.ujian.ujian-info', [
            'title' => $exam->judul,
            'exam' => $exam,
            'kelas' => $kelas,
            'soalPertama' => $soalPertama
        ]);

    }

    public function kerjain(Classroom $kelas, $slug, Question $soal)
    {
        $exam = $kelas->exams()->where('slug', $slug)->first();

        // Navigasi
        $nextSoal = $exam->questions()->where('question_id', '>', $soal->id)->min('question_id'); 
        $prevSoal = $exam->questions()->where('question_id', '<', $soal->id)->max('question_id');
        // END Navigasi

        $totalSoal = $exam->questions()->count();
        
        $answers = $soal->answers->all();

        $jawabanBenar = [];

        // Data untuk timer
        $now = Carbon::now();
        $start = $now->toDateTimeString();
        $end = $now->addMinutes(6)->toDateTimeString();
        // END Data timer

        foreach ($answers as $answer) {
            if ($answer->benar == 1) {
                $jawabanBenar[] = 1;
            }
        }

        if (count($jawabanBenar) > 1) {
            $choice = 'checkbox';
        } else {
            $choice = 'radio';
        }

        $nomorSoal = $exam->questions()->where('question_id', '<=', $soal->id)->count();

        return view('front.ujian.kerjain',[
            'title' => 'Kerjakan Ujian | ' .  $exam->judul,
            'kelas' => $kelas,
            'exam' => $exam,
            'answers' => $answers,
            'soal' => $soal,
            'totalSoal' => $totalSoal,
            'nomorSoal' => $nomorSoal,
            'nextSoal' => $nextSoal,
            'prevSoal' => $prevSoal,
            'choice' => $choice,
            'start' => $start,
            'end' => $end
        ]);
    }
}
