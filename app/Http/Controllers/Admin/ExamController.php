<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Exam;

use Illuminate\Support\Facades\Route;

class ExamController extends Controller
{

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
            'action' => '/admin/ujian'
        ]);
    }

    public function store(Request $request)
    {        
        if (!empty($request['slug'])) {
            $findSpace = strrpos($request['slug'], " ");
        
            if ($findSpace !== false) {
                $request['slug'] = str_replace(" ", "-", $request['slug']);
            }
        
        }

        $data = $request->validate([
            'judul' => 'required',
            'slug' => 'required|unique:exams',
            'deskripsi' => ''
        ]);

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
        ]);
    }

    
}
