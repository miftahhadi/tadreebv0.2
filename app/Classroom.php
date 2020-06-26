<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Classroom extends Model
{
    protected $guarded = [];

    public function group()
    {
        return $this->belongsTo(Group::class);
    }

    public function users()
    {
        return $this->belongsToMany(User::class);
    }

    public function pages()
    {
        return [
            [
                'title' => 'Beranda',
                'link' => route('kelas.beranda', [$this->id])
            ],
            [
                'title' => 'Pelajaran',
                'link' => route('kelas.pelajaran', [$this->id])
            ],
            [
                'title' => 'Ujian',
                'link' => route('kelas.ujian', [$this->id])
            ],
            [
                'title' => 'Anggota',
                'link' => route('kelas.anggota', [$this->id])
            ]
        ];
    }

    public function exams() {
        return $this->belongsToMany(Exam::class)->using(ClassroomExam::class)->withPivot([
            'tampil', 'buka', 'buka_hasil', 'tampil_otomatis', 'buka_otomatis', 'batas_buka', 'durasi', 'attempt'
        ]);
    }
}
