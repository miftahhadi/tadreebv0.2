<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Lesson;

class LessonController extends Controller
{
    public function index()
    {
        $lessons = Lesson::all();

        return view('admin.lesson.index', [
            'title' => 'Mata Pelajaran',
            'lessons' => $lessons
        ]);
    }

    public function create()
    {
        return view('admin.general.create', [
            'title' => 'Mata Pelajaran Baru | Area Admin',
            'item' => 'pelajaran',
            'judul' => 'Judul Pelajaran',
            'slug' => 'slug pelajaran',
            'url' => 'k/{kode-kelas}/p',
            'action' => '/admin/pelajaran'
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
            'slug' => 'required|unique:lessons',
            'deskripsi' => ''
        ]);

        $lesson = auth()->user()->lessons()->create($data);

        return redirect('/admin/pelajaran/' . $lesson->id);
    }

    public function show(Lesson $lesson) 
    {
        return view('admin.lesson.show', [
            'title' => $lesson->judul . ' | Area Admin',
            'lesson' => $lesson
        ]);
    }
}
