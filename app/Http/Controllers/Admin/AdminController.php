<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AdminController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }
    
    public function index()
    {
        $message = 'Welcome, My Lord';
        
        return view('admin.dashboard',[
            'title' => 'Area Admin',
            'message' => $message
            ]);
    }
}
