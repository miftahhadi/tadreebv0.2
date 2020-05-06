<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Section;

class Lesson extends Model
{
    protected $guarded = [];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function sections()
    {
        return $this->hasMany(Section::class);
    }
}
