<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Group;
use App\Classroom;
use App\Http\Requests\StoreClassroomRequest;

class ClassroomController extends Controller
{
    public function index()
    {

    }

    public function create(Group $grup)
    {
        return view('admin.classroom.create', [
            'title' => 'Tambah Kelas Baru | Area Admin',
            'grup' => $grup
        ]);
    }

    public function show(Group $grup, Classroom $kelas)
    {
        return view('admin.classroom.show');
    }

    public function store(Group $grup, StoreClassroomRequest $request)
    {
        $data = $request->validated();

        $classroom = $grup->classrooms()->create($data);

        return redirect(route('group.show', ['grup'=> $grup->id]));
    }

}
