<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cookie;
use App\Classroom;
use App\Exam;
use App\Question;
use App\ClassroomExam;
use Carbon\Carbon;
use App\Services\Front\InfoUjianService;
use App\Services\Front\KerjainUjianService;

class ExamController extends Controller
{
    public function info(Classroom $kelas, $slug)
    {
        $exam = $kelas->exams()->where('slug', $slug)->first();

        $info = new InfoUjianService($kelas, $slug);

        $info->infoPage();

        return view('front.ujian.ujian-info', [
            'title' => $exam->judul,
            'exam' => $exam,
            'kelas' => $kelas,
            'info' => $info
        ]);

    }

    public function init(Classroom $kelas, $slug, Request $request)
    {

        $info = new InfoUjianService($kelas, $slug);

        // Initialize exam data
        return $info->init();
    }

    public function kerjain(Classroom $kelas, $slug, $soalId)
    {

        $info = new KerjainUjianService($kelas, $slug, $soalId);

        $info->kerjainUjian();

        dd($info->jawabanUser());

        return view('front.ujian.kerjain',[
            'title' => 'Kerjakan Ujian | ' .  $info->ujian->judul,
            'kelas' => $info->kelas,
            'exam' => $info->ujian,
            'answers' => $info->getAnswers(),
            'soal' => $info->soal,
            'totalSoal' => $info->totalSoal(),
            'nomorSoal' => $info->nomorSoal(),
            'nextSoal' => $info->nextSoal(),
            'prevSoal' => $info->prevSoal(),
            'choice' => $info->choice(),
            'start' => $info->start,
            'end' => $info->end,
            'jawabanUser' => $info->jawabanUser()
        ]);
    }

    public function storeJawaban(Classroom $kelas, $slug, $soalId, Request $request)
    {
        $info = new KerjainUjianService($kelas, $slug, $soalId);

        $attempt = $info->riwayat->pivot->attempt;

        // User sudah ngerjain soal yang ini?
        $jawabanUser = $info->jawabanUser();
        
        if (!empty($jawabanUser)) {
            foreach ($jawabanUser as $jwbUser) {
                auth()->user()->answers()->detach($jwbUser['id'], ['soal_id' => $soal->id, 'classroom_exam_id' => $classexam->id, 'attempt' => $attempt]);
            }    
        }

        // Simpan jawaban
        $answers = [];
        foreach ($request->jawaban as $jawaban) {
            // $answers[$jawaban] = ['soal_id' => $soal->id, 'classroom_exam_id' => $classexam->id, 'attempt' => $attempt];
            $answer = auth()->user()->answers()->attach($jawaban,['soal_id' => $soal->id, 'classroom_exam_id' => $classexam->id, 'attempt' => $attempt]);
        }

        // if (empty($jawabanUser)) {
            // $jawaban = auth()->user()->answers()->attach($answers);
        // } else {
        //     foreach ($request->jawaban as $answer) {

        //         $jawaban = auth()->user()->answers()->updateExistingPivot($answer, ['soal_id' => $soal->id, 'classroom_exam_id' => $classexam->id, 'attempt' => $attempt]);

        //         dd($jawaban);
        //     }
        // }

        if(is_null($nextSoal)) {
            $nextSoal = $soal->id;
        }

        return redirect(route('ujian.kerjain', ['kelas' => $kelas->id, 'slug' => $exam->slug, 'soal' => $nextSoal]));

    }

    public function submitted()
    {
        return view('front.ujian.submitted', [
            'title' => 'Selamat!'
        ]);
    }
}
