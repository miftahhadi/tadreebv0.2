@extends('layouts.admin')

@section('page')
<!-- Page Title and Stuffs -->
<div class="page-header">
    <h3 class="page-title">{{ ucwords($item) }} Baru</h3>
</div>
<!-- END Page Title and Stuffs -->
<form action="/admin/user" method="post" class="row">
@csrf
<div class="col-md-10">

    <div class="card">
        <div class="card-body">
        <h3 class="card-title">Masukkan Data User</h3>
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="nama" class="form-label">Nama</label>
                        <input type="text" class="form-control @error('nama') is-invalid @enderror" name="nama" id=nama" placeholder="Masukkan nama depan" value="{{ old('nama') ?? '' }}">

                        @error('nama')
                        <small class="text-danger">{{ $message }}</small>
                        @enderror  

                    </div>
                </div>

                <div class="col-md-6">
                    <div class="form-group">
                        <label for="email" class="form-label">Email</label>
                        <input type="email" class="form-control @error('email') is-invalid @enderror" name="email" id="email" placeholder="Masukkan email" value="{{ old('email') ?? '' }}">

                        @error('email')
                        <small class="text-danger">{{ $message }}</small>
                        @enderror  

                    </div>
                </div>

                <div class="col-md-6">
                    <div class="form-group">
                        <label for="username" class="form-label">Username</label>
                        <input type="text" class="form-control @error('username') is-invalid @enderror" name="username" id="username" placeholder="Masukkan username" value="{{ old('username') ?? '' }}">

                        @error('username')
                        <small class="text-danger">{{ $message }}</small>
                        @enderror  

                    </div>
                </div>

                <div class="col-md-6">
                    <div class="form-group">
                        <label for="password" class="form-label">Password</label>
                        <input type="password" class="form-control @error('password') is-invalid @enderror" name="password" id="password" placeholder="Masukkan password">

                        @error('password')
                        <small class="text-danger">{{ $message }}</small>
                        @enderror  

                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="role" class="form-label">Peran</label>
                        <select class="form-control custom-select" name="role" id="role">
                        <option value="1">Peserta</option>
                        <option value="2">Teacher</option>
                        <option value="3">Administrator</option>
                        </select>
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="form-group">
                        <label for="gender" class="form-label">Jenis Kelamin</label>
                        <select class="form-control custom-select" name="gender" id="gender">
                            <option value="1" selected>Laki-laki</option>
                            <option value="2">Perempuan</option>
                        </select>
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="form-group">
                        <label for="tanggal_lahir" class="form-label">Tanggal lahir</label>
                        <input type="date" class="form-control" name="tanggal_lahir" id="tanggal_lahir" value="{{ old('tanggal_lahir') ?? '' }}">
                    </div>
                </div>

            </div>   
            
        </div>
    </div>
    <a href="#" class="btn btn-secondary mr-1">Batal</a>
    <input type="submit" name="submit" value="Simpan" class="btn btn-primary">

</div>

</form>
@endsection