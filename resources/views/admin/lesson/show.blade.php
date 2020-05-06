@extends('layouts.admin')

@section('page')
<!-- Page Title and Stuffs -->
<div class="row mt-5">
    <h2>{{ $lesson->judul }}</h2>
</div>
<div class="row">
    {!! $lesson->deskripsi !!}
</div>

<!-- END Page Title and Stuffs -->
<div class="row mt-4">
    <div class="card">
        <div class="card-header">
            <span class="card-title">Konten Pelajaran</span>
            <div class="card-options">
                <a href="/admin/pelajaran/{lesson}/bab/create" class="btn btn-primary btn-xs">Tambah Bab Pelajaran</a>
            </div> 
        </div>
        <div class="card-body">
            <ul class="list-group">
                <li class="card-header list-group-item" id="heading_" data-toggle="collapse" data-target="#section_2" aria-expanded="true" aria-controls="collapse1">
                    Placement Test Nahwu Dasar 2          
                </li>
                <div id="section_2" class="collapse show" style="">
                    <div class="card card-body">
                        <ul class="list-group list-group-transparent mb-0">
                            <li class="list-group-item list-group-item-action d-flex align-items-center active">
                                <span class="mr-3">
                                    <i class="fe fe-check-circle"></i>
                                </span>
                                <div>
                                    <span class="m-0">Placement Test Nahwu 2</span>
                                </div>
                            </li>
                            <div class="ml-auto">
                                <a href="index.php?page=pelajaran&amp;action=editsection&amp;id=2&amp;sectionId=2" class="btn btn-primary btn-sm">Edit</a>
                                <button type="button" class="btn btn-danger btn-sm" data-toggle="modal" data-target="#deleteSection_">Hapus</button>
                            </div>
                        </ul>
                    </div>
                </div>
            </ul>
        </div>
    </div>
</div>


@endsection