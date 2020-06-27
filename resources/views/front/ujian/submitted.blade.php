@extends('layouts.front')

@section('page')
<div class="row d-flex justify-content-center pt-5">
    <div class="col-md-7">
        <div class="card">
            <div class="card-body text-center">
                
                <span class="avatar avatar-xl bg-success text-white"><i class="fas fa-check"></i></span>
                    
                <h1 class="mb-4">Selamat! Anda Selesai Mengerjakan Ujian</h1>
                <p class="lead mb-4 px-sm-5">
                    Terima kasih {{ auth()->user()->nama }}, data ujian Anda sudah tersimpan di database.
                </p>
                <a class="btn btn-primary" href="{{ route('main.index') }}">Kembali ke Halaman Depan</a>

            </div>
        </div>
    </div>
</div>
@endsection