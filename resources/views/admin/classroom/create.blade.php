@extends('layouts.admin')

@section('page')

<!-- Page Title and Stuffs -->

    <nav aria-label="breadcrumb" class="row">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="#">Dashboard</a></li>
            <li class="breadcrumb-item"><a href="#">{{ $grup->nama }}</a></li>
            <li class="breadcrumb-item active" aria-current="page">Kelas Baru</li>
        </ol>
    </nav>
    <h3 class="row page-title">Tambah Kelas Baru</h3>        


<!-- END Page Title and Stuffs -->
<form action="/admin/grup/{{ $grup->id }}/kelas" method="post">
@csrf
    <div class="row">
        <div class="card">
            <div class="card-body">
                <div class="form-group">
                    <label class="form-label">Nama kelas<span class="form-required">*</span></label>
                    <input type="text" class="form-control @error('nama') is-invalid @enderror" name="nama" placeholder="Tuliskan nama" value="{{ old('nama') ?? '' }}">

                    @error('nama')
                    <div class="invalid-feedback">{{ $message }}</div>
                    @enderror

                </div>

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