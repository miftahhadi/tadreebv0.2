<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Exam;
use App\Http\Requests\StoreExamRequest;
use Illuminate\Support\Facades\Route;

class ExamController extends Controller
{

    private $questionTypes = [
        [
            'type' => 'Jawaban Ganda',
            'value' => 'multiple'

        ],
        [
            'type' => 'Pilihan Ganda',
            'value' => 'single'
        ],
        [
            'type' => 'Benar-Salah',
            'value' => 'benarsalah'
        ],
        [
            'type' => 'صحيح-خطأ',
            'value' => 'benarsalahArabic'
        ]
    ];

    private $answerIcons = [
        'benar' => '<i class="fas fa-check-circle"></i>',
        'salah' => '<i class="fas fa-times-circle"></i>'
    ];

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $exams =\App\Exam::all();

        return view('admin.exam.index', [
            'title' => 'Daftar Mata Ujian | Area Admin',
            'exams' => $exams
        ]);
    }

    public function create()
    {

        return view('admin.general.create', [
            'title' => 'Mata Ujian Baru | Area Admin',
            'item' => 'ujian',
            'judul' => 'Judul Ujian',
            'slug' => 'kode ujian',
            'url' => 'k/{kode-kelas}/u',
            'action' => '/admin/ujian'
        ]);
    }

    public function store(StoreExamRequest $request)
    {     

        $data = $request->validated();

        $exam = auth()->user()->exams()->create($data);

        return redirect('/admin/ujian/' . $exam->id);

    }

    public function show(Exam $exam)
    {
        // Lazy load the questions and answers to avoid N+1 problem
        $exam->load('questions.answers');

        return view('admin.exam.show', [
            'title' => $exam->judul . ' | Area Admin',
            'exam' => $exam,
            'questionTypes' => $this->questionTypes,
            'answerIcons' => $this->answerIcons
        ]);
    }

    
}
