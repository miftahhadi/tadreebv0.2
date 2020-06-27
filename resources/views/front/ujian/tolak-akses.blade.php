@extends('layouts.basic')

@section('content')
<div class="container-tight py-6">
    <div class="empty">
        <div class="empty-icon">
            <div class="display-4">Akses Ditolak</div>
        </div>
        <p class="empty-title h3">Anda tidak diizinkan mengakses ujian ini</p>
        <p class="empty-subtitle text-muted">
        Mohon maaf, jika ini kesalahan silakan hubungi Admin
        </p>
        <div class="empty-action">
        <a href="{{ route('main.index') }}" class="btn btn-primary">
            <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z"/><line x1="5" y1="12" x2="19" y2="12" /><line x1="5" y1="12" x2="11" y2="18" /><line x1="5" y1="12" x2="11" y2="6" /></svg>
            Ke Halaman Depan
        </a>
        </div>
    </div>
</div>
@endsection