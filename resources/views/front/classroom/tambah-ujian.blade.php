@extends('front.classroom.main')

@section('classContent')
<div class="page-header">
    <div class="page-title">
        Tambah Ujian
    </div>
</div>
<form action="{{ route('kelas.ujian.assign', ['kelas' => $kelas->id]) }}" method="post">
@csrf
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
                    <input class="form-check-input m-0 align-middle" type="checkbox" name="ujianId[]" value="{{ $exam->id }}" aria-label="Pilih ujian ini" id="ujian[{{ $exam->id }}]">
                </th>
                <td><label for="ujian[{{ $exam->id }}]">{{ $exam->judul }}</label></td>
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