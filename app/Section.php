<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Lesson;

class Section extends Model
{
    protected $guarded = [];

    public function lesson()
    {
        return $this->belongsTo(Lesson::class);
    }
}
