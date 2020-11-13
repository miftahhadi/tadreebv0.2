<?php

namespace App\Services\Front;

use Illuminate\Http\Request;
use App\Classroom;
use App\Exam;
use Carbon\Carbon;

class KerjainUjianService extends InfoUjianService
{
    public $soal;
    public $start;
    public $end;

    public function __construct(Classroom $kelas, Exam $exam, $soalId)
    {
        parent::__construct($kelas, $exam);
        $this->soal = $this->getSoal($soalId);
    }

    public function kerjainUjian()
    {
        // Kalau belum pernah ngerjain, arahkan ke halaman info
        if (!$this->riwayat) {
            return redirect(route('ujian.info', ['kelas' => $this->kelas, 'exam' => $this->ujian->slug]));
        }


        // Data untuk timer
        if ($this->isTimed()) {

            $now = Carbon::now();

            $waktuMulai = new Carbon($this->cekWaktuMulai()); // Carbon object
            $this->start = $waktuMulai->valueOf();

            $endDate = $waktuMulai->addMinutes($this->classexam->durasi)->toDateTimeString(); // string
            $waktuHabis = new Carbon($endDate); // Carbon object
            $this->end = $waktuHabis->valueOf();

            if ($now > $waktuHabis) {
                return redirect(route('ujian.submitted'));
            }

        }

    }

    public function getSoal($soalId)
    {
        return $this->ujian->questions()->findOrFail($soalId);
    }

    public function totalSoal()
    {
        return $this->ujian->questions()->count();
    }

    public function getAnswers()
    {
        return $this->soal->answers->all();
    }

    public function choice()
    {
        if ($this->soal->tipe == 'Jawaban Ganda') {
            return 'checkbox';
        } elseif ($this->soal->tipe == 'Pilihan Ganda' || $this->soal->tipe == 'Benar/Salah') {
            return 'radio';
        }
    }

    public function cekWaktuMulai()
    {
        return $this->riwayat->pivot->waktu_mulai;
        
    }


    public function isTimed()
    {
        return ($this->classexam->durasi || $this->classexam->durasi == 0);
    }

    public function nextSoal()
    {
        $next = $this->ujian->questions()->where('question_id', '>', $this->soal->id)->min('question_id');

        return (is_null($next)) ? $this->soal->id : $next; 
    }

    public function prevSoal()
    {
        return $this->ujian->questions()->where('question_id', '<', $this->soal->id)->max('question_id');
    }

    public function nomorSoal()
    {
        return $this->ujian->questions()->where('question_id', '<=',$this->soal->id)->count();
    }

    public function jawabanUser()
    {
        return auth()->user()->answers()->where(
            ['soal_id' => $this->soal->id],
            ['classroom_id' => $this->classexam->id]
        )->get()->toArray();
    }

    public function storeJawaban(Request $request)
    {
        if (is_null($request->jawaban)){
            return;
        }

        // Cek peserta sudah pernah jawab atau belum
        $jawabanUser = $this->jawabanUser();

        // Kalau user pernah menjawab, hilangkan dulu jawaban sebelumnya
        if (!empty($jawabanUser)) {
            $hapusJawaban = $this->deletePreviousAnswer($jawabanUser);
        }

        // Simpan jawaban
        $simpan = $this->simpanJawaban($request);

    }

    public function deletePreviousAnswer(Array $jawabanUser)
    {
        foreach ($jawabanUser as $jawaban) {
            auth()->user()
                    ->answers()
                    ->detach($jawaban['id'], [
                        'soal_id' => $this->soal->id, 
                        'classroom_exam_id' => $this->classexam->id, 
                        'attempt' => $this->riwayat->pivot->attempt
                    ]);
        }
    }

    public function simpanJawaban(Request $request)
    {
        $answers = [];

        foreach ($request->jawaban as $jawaban) {
            $simpan = auth()->user()
                    ->answers()
                    ->attach($jawaban,[
                        'soal_id' => $this->soal->id,
                        'classroom_exam_id' => $this->classexam->id,
                        'attempt' => $this->riwayat->pivot->attempt
                ]);
            
            ($simpan) ? array_push($answers, $jawaban->id) : 0;
        }

        return $answers;
    }

}