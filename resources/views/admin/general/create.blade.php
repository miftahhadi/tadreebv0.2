@extends('layouts.admin')

@section('page')
<!-- Page Title and Stuffs -->
<div class="row">
  <div class="page-header">
    <h3 class="page-title">{{ ucwords($item) }} Baru</h3>
  </div>
</div>
<!-- END Page Title and Stuffs -->
<form action="{{ $action }}" method="post">
@csrf
  <div class="row">
    <div class="card">
      <div class="card-body">
        <div class="form-group">
          <label class="form-label">{{ $judul }}<span class="form-required">*</span></label>
          <input type="text" class="form-control @error('judul') is-invalid @enderror" name="judul" placeholder="Tuliskan judul" value="{{ old('judul') ?? '' }}">

          @error('judul')
          <div class="invalid-feedback">{{ $message }}</div>
          @enderror

        </div>

        @if (request()->route()->named('create_lesson') || request()->route()->named('create_exam'))
        <div class="form-group">
          <label class="form-label">URL<span class="form-required">*</span></label>
          <div class="input-group">
            <span class="input-group-prepend" id="basic-addon3">
              <span class="input-group-text">{{ $_SERVER['SERVER_NAME'] }}/{{ $item }}/</span>
            </span>
            <input type="text" name="slug" class="form-control @error('slug') is-invalid @enderror" placeholder="judul-{{ $item }}-anda" value="{{ old('slug') ?? '' }}">
          </div>
          <small>Gunakan (-) sebagai pemisah antar kata, bukan spasi</small><br>

          @error('slug')
          <small class="text-danger">{{ $message }}</small>
          @enderror  

        </div>
        @endif

        <div class="form-group">
          <label class="form-label">
            Deskripsi
            <span class="form-label-small">Maks: 600 karakter</span>
          </label>
          <textarea class="form-control @error('deskripsi') is-invalid @enderror" name="deskripsi" rows="6" placeholder="Deskripsi...">{{ old('deskripsi') ?? '' }}</textarea>
        
          @error('deskripsi')
            <div class="invalid-feedback">{{ $message }}</div>
          @enderror

        </div>
      </div>
    </div>
    <a href="#" class="btn btn-secondary mr-1">Batal</a>
    <input type="submit" name="submit" value="Simpan" class="btn btn-primary">
  </div>

</form>
@endsection