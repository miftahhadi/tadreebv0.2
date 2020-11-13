@extends('layouts.front')

@section('page')
<div class="row d-flex justify-content-center pt-5">
    <div class="col-md-7">
        <div class="card">
            <div class="card-body">
                <div class="row align-items-center gutters-sm">
                    <div class="col text-center">
                        <div class="display-6 font-weight-bold">{{ $exam->judul }}</div>
                    </div>
                </div>
                <table class="card-table table table-center table-md mt-4">
                    <tbody>
                        <tr>
                            <td colspan="2" class="font-weight-bold">Informasi Ujian</td>
                        </tr>
                        <tr>
                            <td width="50%">Jumlah Soal</td>
                            <td>{{ $info->totalSoal }}</td>
                        </tr>
                        <tr>
                            <td width="50%">Durasi</td>
                            <td>{{ $exam->pivot->durasi ?? 'Tidak dibatasi' }}</td>
                        </tr>
                        <tr>
                            <td width="50%">Batas Akses</td>
                            <td>{{ $exam->pivot->batas_buka ?? 'Tidak dibatasi' }}</td>
                        </tr>
                        <tr>
                            <td colspan="2">
                                <div class="alert @if ($info->isDone() != 'sudah') alert-info @else alert-success @endif">
                                    {{ $info->pesan }}
                                </div>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
        <div class="alert alert-warning" role="alert">
            <ol>
                <li>Awali segala hal baik dengan basmalah dan niat yang benar</li>
                <li>Jelilah ketika membaca soal</li>
            </ol>
        </div>
        <div class="text-center">
            <a href="{{ route('main.index') }}" class="btn btn-white">Kembali</a>

            @if ($info->isDone() == 'sudah')
            <a href="{{ route('ujian.hasil.detail', ['kelas' => $kelas->id, 'exam' => $exam->slug, 'user' => auth()->user()->id]) }}" 
                class="btn btn-primary">
                Lihat Hasil
            </a>
            @endif

            <a href="@if ($info->allowed === true) {{ route('ujian.init', ['kelas' => $kelas->id, 'exam' => $exam->slug]) }} @else # @endif" 
                class="btn btn-success @if ($info->allowed !== true) disabled @endif">
                Mulai Kerjakan
            </a>
        </div>
    </div>
</div>
@endsection