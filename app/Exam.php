<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Exam extends Model
{

    protected $guarded = [];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function questions()
    {
        return $this->belongsToMany(Question::class)->withPivot(['urutan']);
    }

    public function classrooms()
    {
        return $this->belongsToMany(Classroom::class)->using(ClassroomExam::class);
    }
}
