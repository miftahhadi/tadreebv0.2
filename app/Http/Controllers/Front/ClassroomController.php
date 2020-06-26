<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Classroom;
use App\Group;
use App\User;
use App\Exam;

class ClassroomController extends Controller
{
    public function index(Classroom $kelas)
    {

        return view('front.classroom.index', [
            'title' => 'Beranda | ' . $kelas->nama, 
            'kelas' => $kelas
        ]);
    }

    public function anggota(Classroom $kelas)
    {
        $users = $kelas->users->all();

        return view('front.classroom.anggota', [
            'title' => 'Anggota | ' . $kelas->nama,
            'kelas' => $kelas,
            'users' => $users,
        ]);
    }

    public function tambahAnggota(Classroom $kelas)
    {
        $users = User::all();

        $assigned = [];

        foreach ($users as $user) {
            $assigned[$user->id] = $kelas->users->contains($user->id);
        }

        return view('front.classroom.tambah-anggota', [
            'title' => 'Tambah Anggota | ' . $kelas->nama,
            'kelas' => $kelas,
            'users' => $users,
            'assigned' => $assigned
        ]);

    }

    public function pelajaran(Classroom $kelas)
    {
        return view('front.classroom.pelajaran',[
            'title' => 'Pelajaran | ' . $kelas->nama,
            'kelas' => $kelas
        ]);
    }

    public function tambahPelajaran(Classroom $kelas)
    {
        $lessons = \App\Lesson::all();

        return view('front.classroom.tambah-pelajaran',[
            'title' => 'Tambah Pelajaran | ' . $kelas->nama,
            'kelas' => $kelas,
            'lessons' => $lessons
        ]);
    }

    public function tambahUjian(Classroom $kelas)
    {
        $exams = Exam::has('classroom');

        return view('front.classroom.tambah-ujian',[
            'title' => 'Tambah Ujian | ' . $kelas->nama,
            'kelas' => $kelas,
            'exams' => $exams
        ]);
    }

    public function ujian(Classroom $kelas)
    {
        return view('front.classroom.ujian', [
            'title' => 'Ujian | ' . $kelas->nama,
            'kelas' => $kelas
        ]);
    }

}
