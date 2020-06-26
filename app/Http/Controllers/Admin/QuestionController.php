<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Exam;
use App\Question;
use App\Answer;
use App\Services\QuestionService;

class QuestionController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function create(Request $request, Exam $exam)
    {

        $question = new QuestionService();
        $questionForm = $question->createQuestionForm($request);

        return view('admin.question.create', [
            'title' => 'Soal baru | ' . $exam->judul,
            'exam' => $exam,
            'choices' => $questionForm['choices'],
            'value' => $questionForm['value'] ?? '',
            'option' => $questionForm['option']
        ]);
    }

    public function store(Request $request, Exam $exam)
    {
        // Validasi input soal
        // Soal gak boleh kosong
        $dataSoal = $request->validate([
            'soal.konten' => 'required',
            'soal.tipe' => ''
        ]);

        // Make as an instance of Question class
        $soal = new Question($dataSoal['soal']);

        // Cek urutan
        $urutan = $exam->questions()->max('urutan');

        $urutan = is_null($urutan) ? 1 : $urutan + 1;

        // Save the question and assign to the exam
        $exam->questions()->save($soal, ['urutan' => $urutan]);

        // Cek jawaban
        if ($dataSoal['soal']['tipe'] != '4') {
        
            // Buat array answers
            $answers = array();

            $jawabanBenar = array();
            foreach ($request['jawaban'] as $jawaban) {
                
                $jawaban['nilai'] = $jawaban['nilai'] ?? 0;

                // Masukkan ke array answers
                $answers[] = $jawaban;

                if (array_key_exists('benar',$jawaban) && $jawaban['benar'] == 1) {
                    $jawabanBenar[] = 1;
                }

            }

            // Save the answers and assign them to the question
            $soal->answers()->createMany($answers);

            // Kalau tipe multiple tapi jawaban benar cuma satu, update tipe soal
            if ($soal->tipe == 2 && count($jawabanBenar) <= 1) {
                $soal->tipe = 1;
                $soal->save();
            }

        }

        // Kembali ke halaman ujian
        return redirect(route('exam.show', ['exam' => $exam->id]));
    }

    public function show(Exam $exam, Question $soal)
    {
        $option = '';

        if ($soal->tipe == 'Jawaban Ganda') {
            $option = 'checkbox';
        } elseif ($soal->tipe == 'Pilihan Ganda') {
            $option = 'radio';
        }

        return view('admin.question.edit', [
            'title' => 'Edit Soal | ' . $exam->judul,
            'exam' => $exam,
            'soal' => $soal,
            'option' => $option
        ]);
    }

    public function preview(Exam $exam, Question $soal)
    {

        return $soal;
    
    }

    public function update(Request $request, Exam $exam)
    {
        // Simpan soal
        $soal = Question::findOrFail($request->soal['id']);

        $soal->konten = $request->soal['konten'];

        $soal->save();

        // Simpan jawaban
        $answers = [];

        foreach ($request->jawaban as $key => $jawaban) {
            $answer = Answer::findOrFail($key);

            $answer->redaksi = $jawaban['redaksi'];

            $answer->benar = $jawaban['benar'] ?? 0;

            $answer->nilai = $jawaban['nilai'];
            
            $answers[] = $answer;
        }

        $soal->answers()->saveMany($answers);

        return redirect(route('exam.show', ['exam' => $exam->id]));
    }

    public function unlinkSoal(Exam $exam, Request $request)
    {
        $exam->questions()->detach($request->soalId);

        return redirect(route('exam.show', ['exam' => $exam->id]));

    }

}
