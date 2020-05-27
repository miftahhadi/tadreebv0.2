<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Group;
use App\Http\Requests\StoreGroupRequest;

class GroupController extends Controller
{
    public function index() 
    {

    }

    public function create()
    {
        return view('admin.general.create', [
            'title' => 'Tambah Grup Baru | Area Admin',
            'item' => 'group',
            'judul' => 'Nama Grup',
            'action' => '/admin/grup'
        ]);
    }

    public function store(StoreGroupRequest $request) 
    {
        $data = $request->validated();

        $grup = Group::create([
            'nama' => $data['judul'],
            'deskripsi' => $data['deskripsi']
        ]);

        return redirect('/admin/grup/' . $grup->id);
        
    }

    public function show(Group $grup)
    {

    }
}
