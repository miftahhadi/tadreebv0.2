<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Classroom;
use App\Group;

class ClassroomController extends Controller
{
    public function index()
    {
        
    }

    public function anggota(Classroom $kelas)
    {
        $users = $kelas->users->all();

        return view('front.classroom.anggota', [
            'title' => 'Anggota | ' . $kelas->nama . ' | Area Admin',
            'kelas' => $kelas,
            'users' => $users,
        ]);
    }

    public function tambahAnggota(Classroom $kelas)
    {
        $users = \App\User::all();

        $assigned = [];

        foreach ($users as $user) {
            $assigned[$user->id] = $kelas->users->contains($user->id);
        }

        return view('front.classroom.tambah-anggota', [
            'title' => 'Tambah Anggota | ' . $kelas->nama . ' | Area Admin',
            'kelas' => $kelas,
            'users' => $users,
            'assigned' => $assigned
        ]);

    }

    public function pelajaran(Classroom $kelas)
    {
        return view('front.classroom.pelajaran',[
            'title' => 'Pelajaran | ' . $kelas->nama . ' | Area Admin',
            'kelas' => $kelas
        ]);
    }

    public function tambahPelajaran(Classroom $kelas)
    {
        $lessons = \App\Lesson::all();

        return view('front.classroom.tambah-pelajaran',[
            'title' => 'Tambah Pelajaran | ' . $kelas->nama . ' | Area Admin',
            'kelas' => $kelas,
            'lessons' => $lessons
        ]);
    }

    public function ujian(Classroom $kelas)
    {
        return view('front.classroom.ujian', [
            'title' => 'Ujian | ' . $kelas->nama . ' | Area Admin',
            'kelas' => $kelas
        ]);
    }

}
