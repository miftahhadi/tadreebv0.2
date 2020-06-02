<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\User;
use App\Classroom;

class AssignUserController extends Controller
{
    public function store(Classroom $kelas, User $user) {
        
        return $kelas->users()->toggle($user->id);        
        
    }
}
