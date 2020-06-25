<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\StoreUserRequest;
use Illuminate\Support\Facades\Hash;
use App\User;

class UserController extends Controller
{
    public function create()
    {
        return view('admin.user.create', [
            'title' => 'Tambah User Baru | Area Admin',
            'item' => 'User',
            'action' => '#'
        ]);
    }

    public function store(StoreUserRequest $request)
    {
        $data = $request->validated();
        $user = User::create([
            'nama' => $data['nama'],
            'email' => $data['email'],
            'username' => $data['username'],
            'password'=> Hash::make($data['password']),
            'gender' => $data['gender'],
            'tanggal_lahir' => $data['tanggal_lahir']
        ]);

        // Assign role
        $user->roles()->toggle($data['role']);

        return redirect('/admin/user');
    }

    public function index() {
        $users = User::all();

        return view('admin.user.index', [
            'title' => 'Daftar User | Area Admin',
            'users' => $users
        ]);
    }
}
