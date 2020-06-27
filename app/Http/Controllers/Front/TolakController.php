<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class TolakController extends Controller
{
    public function index()
    {
        return view('front.ujian.tolak-akses', [
            'title' => 'Akses ditolak'
        ]);
    }
}
