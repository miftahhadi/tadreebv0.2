<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Group;
use App\Classroom;
use App\Http\Requests\StoreClassroomRequest;

class ClassroomController extends Controller
{
    public function index()
    {

    }

    public function create(Group $grup)
    {
        return view('admin.classroom.create', [
            'title' => 'Tambah Kelas Baru | Area Admin',
            'grup' => $grup
        ]);
    }

    public function show(Group $grup, Classroom $kelas)
    {
        return view('admin.classroom.show');
    }

    public function store(Group $grup, StoreClassroomRequest $request)
    {
        $data = $request->validated();

        $classroom = $grup->classrooms()->create($data);

        return redirect('/admin/kelas/' . $classroom->id);
    }

    public function anggota(Classroom $kelas)
    {
        $template = 'admin.classroom.anggota';

        $users = $kelas->users->all();

        if (request('assign') && request('assign') == 'peserta') {
            $template = 'admin.classroom.tambah-anggota';

            $users = \App\User::all();

            $assigned = [];

            foreach ($users as $user) {
                $assigned[$user->id] = $kelas->users->contains($user->id);
            }

        } 

        return view($template, [
            'title' => 'Anggota | ' . $kelas->nama . ' | Area Admin',
            'kelas' => $kelas,
            'users' => $users ?? '',
            'assigned' => $assigned ?? ''
        ]);
    }

    public function pelajaran(Classroom $kelas)
    {
        $template = ''
    }
}
