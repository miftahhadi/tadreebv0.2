<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'nama', 'email', 'username', 'password', 'gender', 'tanggal_lahir'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function roles()
    {
        return $this->belongsToMany(Role::class);
    }

    public function lessons()
    {
        return $this->hasMany(Lesson::class);
    }

    public function exams()
    {
        return $this->hasMany(Exam::class);
    }

    public function classrooms()
    {
        return $this->belongsToMany(Classroom::class);
    }

    public function isAdmin()
    {
        foreach ($this->roles->all() as $role) {
            $admin = $role->tipe == 'Admin';

            if ($admin === true) {
                return $admin;
            }
        }

        return $admin;
    }

    public function isTeacher()
    {
        foreach ($this->roles->all() as $role) {
            $teacher = $role->tipe == 'Teacher';

            if ($teacher === true) {
                return $teacher;
            }
        }

        return $teacher;
    }

    public function isPeserta()
    {
        foreach ($this->roles->all() as $role) {
            $peserta = $role->tipe == 'Peserta';

            if ($peserta === true) {
                return $peserta;
            }
        }

        return $peserta;
    }
}
