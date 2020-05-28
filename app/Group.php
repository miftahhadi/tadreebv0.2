<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Classroom;

class Group extends Model
{
    protected $guarded = [];

    public function classrooms()
    {
        return $this->hasMany(Classroom::class);
    }
}
