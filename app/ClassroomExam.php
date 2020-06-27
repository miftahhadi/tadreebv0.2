<?php

namespace App;

use Illuminate\Database\Eloquent\Relations\Pivot;

class ClassroomExam extends Pivot
{
    public function users()
    {
        return $this->belongsToMany(User::class);
    }
}