@extends('layouts.admin')

@section('page')
<!-- Page Title and Stuffs -->
<div class="page-header">
    <div>
        <div class="page-description">{{ $kelas->group->nama }}</div>
        <h3 class="page-title">Tambah Pelajaran ke {{ $kelas->nama }}</h3>
    </div>
</div>
<!-- END Page Title and Stuffs -->

<div class="card">
    <table class="table card-table table-vcenter"  id="app">
        <tr>
            <th class="w-1">
            </th>
            <th>Nama</th>
            <th class="d-none d-sm-table-cell">Kategori</th>
            <th class="d-none d-md-table-cell"></th>
        </tr>
        @foreach ($lessons as $lesson)
        <tr>
            <th>
                <label class="custom-control custom-checkbox">
                    <input type="checkbox" class="custom-control-input" name="users[]" value="{{ $user->id }}">
                    <div class="custom-control-label"></div>
                </label>
            </th>
            <td>{{ $lesson->judul }}</td>
            <td class="d-none d-sm-table-cell"></td>
            <td class="d-none d-md-table-cell text-right"><assign-user-button user-id="{{ $user->id }}" kelas-id="{{ $kelas->id }}" assigned="{{ $assigned[$user->id] }}"></assign-user-button></td>
        </tr>
        @endforeach
    </table>
</div>
<input type="submit" value="Tambahkan ke kelas" class="btn btn-primary">
<script type="text/javascript" src="/js/app.js"></script>
@endsection