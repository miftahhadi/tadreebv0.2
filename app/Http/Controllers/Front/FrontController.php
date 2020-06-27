<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class FrontController extends Controller
{
    public function index()
    {

        $daftarKelas = auth()->user()->classrooms->load('exams');

        return view('front.index.index', [
            'title' => 'Beranda',
            'daftarKelas' => $daftarKelas
        ]);
    }
}
