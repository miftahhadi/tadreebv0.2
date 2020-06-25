@extends('layouts.admin')

@section('page')
<!-- Page Title and Stuffs -->
<div class="page-header">
    <div class="row">
        <div class="col-auto">
            <h3 class="h1 mt-0 mb-3">{{ ucwords($item) }} Baru</h3>
        </div>
    </div>
</div>
<!-- END Page Title and Stuffs -->
<form action="{{ $action }}" method="post">
@csrf
    <div class="row">
        <div class="col">
            <div class="card">
                <div class="card-body">
                    <div class="form-group mb-3">
                        <label class="form-label required">{{ $judul }}</label>
                        <input type="text" class="form-control @error('judul') is-invalid @enderror" name="judul" placeholder="Tuliskan judul" value="{{ old('judul') ?? '' }}">

                        @error('judul')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror

                    </div>

                        @if (request()->route()->named('lesson.create') || request()->route()->named('exam.create'))
                    <div class="form-group mb-3">
                        <label class="form-label required">{{ ucwords($slug) }}</label>
                        <div class="input-group">
                            <span class="input-group-prepend">
                            <span class="input-group-text">{{ $_SERVER['SERVER_NAME'] }}/{{ $url }}/</span>
                            </span>
                            <input type="text" name="slug" class="form-control @error('slug') is-invalid @enderror" placeholder="judul-{{ $item }}-anda" value="{{ old('slug') ?? '' }}">
                        </div>
                        <small class="form-hint">Gunakan (-) sebagai pemisah antar kata, bukan spasi.</small>

                        @error('slug')
                        <small class="text-danger">{{ $message }}</small>
                        @enderror  

                    </div>
                    @endif

                    <div class="form-group mb-3">
                    <label class="form-label">
                        Deskripsi
                        <span class="form-label-description">Maks: 600 karakter</span>
                    </label>
                    <textarea class="form-control @error('deskripsi') is-invalid @enderror" name="deskripsi" rows="6" placeholder="Deskripsi...">{{ old('deskripsi') ?? '' }}</textarea>
                    
                    @error('deskripsi')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror

                    </div>
                </div>
            </div>
            <a href="#" class="btn btn-secondary mr-1">Batal</a>
            <input type="submit" name="submit" value="Simpan" class="btn btn-success">
        </div>
    </div>

</form>
@endsection