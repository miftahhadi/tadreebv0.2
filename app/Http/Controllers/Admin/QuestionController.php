<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Exam;
use App\Question;
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

            foreach ($request['jawaban'] as $jawaban) {

                // Masukkan ke array answers
                $answers[] = $jawaban;

            }

            // Save the answers and assign them to the question
            $soal->answers()->createMany($answers);

        }

        // Kembali ke halaman ujian
        return redirect('/admin/ujian/' . $exam->id);
    }

}
