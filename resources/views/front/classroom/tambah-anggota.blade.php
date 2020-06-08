@extends('front.classroom.main')

@section('classContent')
<div class="page-header">
    <div class="page-title">
        Tambah Anggota
    </div>
</div>
<form action="#" method="post">
    <div class="card">
        <table class="table card-table table-vcenter"  id="app">
            <tr>
                <th class="w-1">
                </th>
                <th>Nama</th>
                <th class="d-none d-sm-table-cell">Username</th>
                <th class="d-none d-md-table-cell"></th>
            </tr>
            @foreach ($users as $user)
            <tr>
                <th>
                    <input class="form-check-input m-0 align-middle" type="checkbox" aria-label="Pilih peserta ini" id="peserta[{{ $user->id }}]">
                </th>
                <td><label for="peserta[{{ $user->id }}]">{{ $user->nama }}</label></td>
                <td class="d-none d-sm-table-cell">{{ $user->username }}</td>
                <td class="d-none d-md-table-cell text-right"><assign-user-button user-id="{{ $user->id }}" kelas-id="{{ $kelas->id }}" assigned="{{ $assigned[$user->id] }}"></assign-user-button></td>
            </tr>
            @endforeach
        </table>
    </div>
    <div class="btn-list">
        <a href="{{ route('kelas.anggota', ['kelas' => $kelas->id]) }}" class="btn btn-white">Kembali</a>
        <input type="submit" value="Tambahkan ke kelas" class="btn btn-primary">
    </div>
</form>


<script type="text/javascript" src="/js/app.js"></script>
@endsection