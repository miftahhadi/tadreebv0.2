<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\StoreSectionRequest;
use App\Lesson;
use App\Section;

class SectionController extends Controller
{
    public function create(Lesson $lesson)
    {
        return view('admin.general.create', [
            'title' => 'Bab Pelajaran Baru | Admin Area',
            'item' => 'Bab Pelajaran',
            'judul' => 'Judul Bab',
            'action' => '/admin/pelajaran/' . $lesson->id . '/bab'
        ]);
    }

    public function store(Lesson $lesson, StoreSectionRequest $request)
    {
        $data = $request->validated();

        $section = $lesson->sections()->create($data);

        return redirect('/admin/pelajaran/' . $lesson->id . '/bab/' . $section->id);
    }

    public function show(Lesson $lesson, Section $section)
    {
        dd($section);
    }
}
