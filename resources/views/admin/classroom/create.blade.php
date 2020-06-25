@extends('layouts.admin')

@section('page')

<!-- Page Title and Stuffs -->

<ol class="breadcrumb" aria-label="breadcrumbs">
    <li class="breadcrumb-item"><a href="#">Dashboard</a></li>
    <li class="breadcrumb-item"><a href="#">{{ $grup->nama }}</a></li>
    <li class="breadcrumb-item active" aria-current="page"><a href="#">Buat Kelas Baru</a></li>
</ol>
    
<div class="page-header mt-2">
    <div class="row">
        <div class="col-auto">
            <h3 class="h1 mt-0 mb-3">Buat Kelas Baru</h3>
        </div>
    </div>
</div>  


<!-- END Page Title and Stuffs -->
<form action="{{ route('group.classroom.store', ['grup' => $grup->id]) }}" method="post">
@csrf
    <div class="row">
        <div class="col">
            <div class="card">
                <div class="card-body">
                    <div class="form-group mb-3">
                        <label class="form-label required">Nama kelas</label>
                        <input type="text" class="form-control @error('nama') is-invalid @enderror" name="nama" placeholder="Tuliskan nama" value="{{ old('nama') ?? '' }}">

                        @error('nama')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror

                    </div>

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