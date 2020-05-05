<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class LessonController extends Controller
{
    public function index()
    {
        $lessons = [];

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
}
