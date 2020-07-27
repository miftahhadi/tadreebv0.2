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

    public function kerjain(Classroom $kelas, $slug, $soal)
    {

        $soal = $exam->questions()->findOrFail($soal);

        $info = new InfoUjianService($kelas, $slug);

        // Sudah pernah mengerjakan?
        $rekamPengerjaan = $classexam->users()->where('user_id',auth()->user()->id)->get();

        $dataTerakhir = $rekamPengerjaan->last() ?? null;

        // Kalau belum pernah ngerjain, alihkan ke halaman info
        if (is_null($dataTerakhir)) {
            return redirect(route('ujian.info', ['kelas' => $kelas, 'slug' => $slug]));
        }

        // Data untuk timer
        $now = Carbon::now();

        // Cek waktu mulai dari cookies, kalau gak ada ambil dari database dan simpan cookie
        if (Cookie::get('waktu_mulai')) {
            $start = Cookie::get('waktu_mulai');
        } else {
            $start = $dataTerakhir->pivot->waktu_mulai;
            Cookie::make('waktu_mulai', $start, '300');
        }

        $waktuMulai = new Carbon($start);
        // Cek waktu berakhir
        $end = (new Carbon($start))->addMinutes($classexam->durasi)->toDateTimeString();
        $waktuHabis = new Carbon($end);
        // END Data timer

        // Kalau waktu habis, ke halaman berhasil
        if ($now > $waktuHabis) {
            return redirect(route('ujian.submitted'));
        }

        // Navigasi
        $nextSoal = $exam->questions()->where('question_id', '>', $soal->id)->min('question_id'); 
        $prevSoal = $exam->questions()->where('question_id', '<', $soal->id)->max('question_id');
        // END Navigasi

        $totalSoal = $exam->questions()->count();
        
        $answers = $soal->answers->all();

        $jawabanBenar = [];

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

        // User sudah ngerjain soal yang ini?
        $jawabanUser = auth()->user()->answers()->where(
            ['soal_id' => $soal->id],
            ['classroom_exam_id' => $classexam->id]
        )->get()->toArray();

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
            'end' => $end,
            'jawabanUser' => $jawabanUser ?? ''
        ]);
    }

    public function storeJawaban(Classroom $kelas, $slug, $soal, Request $request)
    {
        // Cek ujian
        $exam = $kelas->exams()->where('slug', $slug)->first();

        $soal = $exam->questions()->find($soal);

        $classexam = ClassroomExam::where([
            ['classroom_id', $kelas->id],
            ['exam_id', $exam->id]
            ])->first();

        // Sudah pernah mengerjakan?
        $rekamPengerjaan = $classexam->users()->where('user_id',auth()->user()->id)->get();

        $dataTerakhir = $rekamPengerjaan->last() ?? null;

        $attempt = $dataTerakhir->pivot->attempt;

        $nextSoal = $exam->questions()->where('question_id', '>', $soal->id)->min('question_id'); 

        // User sudah ngerjain soal yang ini?
        $jawabanUser = auth()->user()->answers()->where(
            ['soal_id' => $soal->id],
            ['classroom_exam_id' => $classexam->id]
        )->get()->toArray();
        
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
