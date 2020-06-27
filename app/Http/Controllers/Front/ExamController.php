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

class ExamController extends Controller
{
    public function info(Classroom $kelas, $slug)
    {
        $exam = $kelas->exams()->where('slug', $slug)->first();

        $totalSoal = $exam->questions()->count();

        $classexam = ClassroomExam::where([
            ['classroom_id', $kelas->id],
            ['exam_id', $exam->id]
            ])->first();

        // Sudah pernah mengerjakan?
        $rekamPengerjaan = $classexam->users()->find(auth()->user()->id);

        if (!is_null($rekamPengerjaan)) {
            $waktuMulai = new Carbon($rekamPengerjaan->pivot->waktu_mulai);

            $waktuHabis = $waktuMulai->addMinutes($classexam->durasi);

            if ($waktuHabis < Carbon::now()) {
                $pesan = 'Anda sudah mengerjakan ujian ini';
                $status = 'done';
            } else {
                $pesan = 'Anda sedang mengerjakan ujian ini';
                $status = 'info';
            }
        } else {
            $pesan = 'Anda belum mengerjakan ujian ini';
            $status = 'info';
        }

        return view('front.ujian.ujian-info', [
            'title' => $exam->judul,
            'exam' => $exam,
            'kelas' => $kelas,
            'totalSoal' => $totalSoal,
            'pesan' => $pesan,
            'status' => $status
        ]);

    }

    public function init(Classroom $kelas, $slug, Request $request)
    {
        // Ambil data ujian
        $exam = $kelas->exams()->where('slug', $slug)->first();
        $soalPertama = $exam->questions()->first();

        $classexam = ClassroomExam::where([
            ['classroom_id', $kelas->id],
            ['exam_id', $exam->id]
            ])->first();

        // Sudah pernah mengerjakan?
        $rekamPengerjaan = $classexam->users()->where('user_id',auth()->user()->id)->get();

        $dataTerakhir = $rekamPengerjaan->last() ?? null;

        if (!is_null($dataTerakhir)) {
            $waktuMulai = new Carbon($dataTerakhir->pivot->waktu_mulai);

            $waktuHabis = $waktuMulai->addMinutes($classexam->durasi);

            if (($waktuHabis < Carbon::now()) && ($classexam->attempt >= 1) && $dataTerakhir->pivot->attempt >= $classexam->attempt ) {

                return redirect(route('denied'));
            
            } elseif (($waktuHabis < Carbon::now()) && ($classexam->attempt >= 1) && $dataTerakhir->pivot->attempt < $classexam->attempt ) {

                $attempt = $dataTerakhir->pivot->attempt++;
                
            } elseif ($waktuHabis < Carbon::now() && ($classexam->attempt >= 0)) {

                $attempt = $dataTerakhir->pivot->attempt++;

            } elseif ($waktuHabis > Carbon::now()) {
                
                return redirect(route('ujian.kerjain', ['kelas' => $kelas, 'slug' => $slug, 'soal' => $soalPertama]));
            
            }

        } else {
            
            $attempt = 1;
        
        }

        // Simpan data
        $classexam->users()->attach(auth()->user()->id, ['attempt' => 1, 'waktu_mulai' => Carbon::now()->toDateTimeString()]);

        return redirect(route('ujian.kerjain', ['kelas' => $kelas, 'slug' => $slug, 'soal' => $soalPertama]));


    }

    public function kerjain(Classroom $kelas, $slug, Question $soal)
    {
        $exam = $kelas->exams()->where('slug', $slug)->first();

        $classexam = ClassroomExam::where([
            ['classroom_id', $kelas->id],
            ['exam_id', $exam->id]
            ])->first();

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

    public function submitted()
    {
        return view('front.ujian.submitted', [
            'title' => 'Selamat!'
        ]);
    }
}
