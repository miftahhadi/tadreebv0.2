<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;

class Question extends Model
{
    protected $guarded = [];

    public function exams()
    {
        return $this->belongsToMany(Exam::class)->withPivot(['urutan']);
    }

    public function answers()
    {
        return $this->hasMany(Answer::class);
    }

}
