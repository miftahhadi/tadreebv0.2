@extends('front.classroom.main')

@section('classContent')
<div class="page-header">
    <div class="page-title">
        Tambah Ujian
    </div>
</div>
<form action="#" method="post">
    <div class="card">
        <table class="table card-table table-vcenter"  id="app">
            <tr>
                <th class="w-1">
                </th>
                <th>Judul Ujian</th>
                <th class="d-none d-sm-table-cell">Kategori</th>
                <th class="d-none d-md-table-cell"></th>
            </tr>
            @forelse ($exams as $exam)
            <tr>
                <th>
                    <input class="form-check-input m-0 align-middle" type="checkbox" aria-label="Pilih peserta ini" id="peserta[{{ $exam->id }}]">
                </th>
                <td><label for="peserta[{{ $exam->id }}]">{{ $exam->judul }}</label></td>
                <td class="d-none d-sm-table-cell"></td>
                <td class="d-none d-md-table-cell text-right"></td>
            </tr>

            @empty
            <tr>
                <td colspan="3">Belum ada ujian</td>
            </tr>
            @endforelse
        </table>
    </div>
    <div class="btn-list">
        <a href="{{ route('kelas.anggota', ['kelas' => $kelas->id]) }}" class="btn btn-white">Kembali</a>
        <input type="submit" value="Tambahkan" class="btn btn-primary">
    </div>
</form>


<script type="text/javascript" src="/js/app.js"></script>
@endsection