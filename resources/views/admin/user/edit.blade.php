@extends('layouts.admin')

@section('page')
<!-- Page Title and Stuffs -->
<div class="page-header">
    <div class="row">
        <div class="col-auto">
            <h3 class="h1 mt-0 mb-3">Edit User</h3>
        </div>
    </div>
</div>
<!-- END Page Title and Stuffs -->
<form action="{{ route('user.update', ['user' => $user->id]) }}" method="post" class="row">
@csrf
@method('PUT')
    <div class="col-md-10">

        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Perbarui Data User</h3>
            </div>
            <div class="card-body">
            
                <div class="form-group mb-3 row">
                    <label class="form-label col-3 col-form-label required">Nama</label>
                    <div class="col">
                        <input type="text" class="form-control @error('nama') is-invalid @enderror" placeholder="Masukkan nama user" name="nama" value="{{ $user->nama }}">

                        @error('nama')
                        <small class="text-danger">{{ $message }}</small>
                        @enderror  

                    </div>
                </div>

                <div class="form-group mb-3 row">
                    <label class="form-label col-3 col-form-label required">Email</label>
                    <div class="col">
                        <input type="email" class="form-control @error('email') is-invalid @enderror" placeholder="Masukkan email" name="email" value="{{ $user->email }}">

                        @error('email')
                        <small class="text-danger">{{ $message }}</small>
                        @enderror  

                    </div>
                </div>

                <div class="form-group mb-3 row">
                    <label class="form-label col-3 col-form-label required">Username</label>
                    <div class="col">
                        <input type="text" class="form-control @error('username') is-invalid @enderror" placeholder="Masukkan username" name="username" value="{{ $user->username }}">

                        @error('username')
                        <small class="text-danger">{{ $message }}</small>
                        @enderror  

                    </div>
                </div>
                
                <div class="form-group mb-3 row">
                    <label class="form-label col-3 col-form-label required">Password</label>
                    <div class="col">
                        <input type="password" class="form-control @error('password') is-invalid @enderror" placeholder="Password" name="password">

                        @error('password')
                        <small class="text-danger">{{ $message }}</small>
                        @enderror  

                    </div>
                </div>

                <div class="form-group mb-3 row">
                    <label class="form-label col-3 col-form-label required">Peran</label>
                    <div class="col">
                        <div>
                            <label class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="role" value="1" @if ($user->isAdmin()) checked @endif>
                                <span class="form-check-label">Administrator</span>
                            </label>
                            <label class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="role" value="2" @if ($user->isTeacher()) checked @endif>
                                <span class="form-check-label">Teacher</span>
                            </label>
                            <label class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="role" value="3" @if ($user->isPeserta()) checked @endif>
                                <span class="form-check-label">Peserta</span>
                            </label>
                        </div>

                        @error('role')
                        <small class="text-danger">{{ $message }}</small>
                        @enderror  
                            
                    </div>
                </div>

                <div class="form-group mb-3 row">
                    <label class="form-label col-3 col-form-label">Jenis Kelamin</label>

                    <div class="col">
                
                        <label class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="gender" value="1" @if ($user->gender == 'Laki-laki') checked @endif>
                            <span class="form-check-label">Laki-laki</span>
                        </label>
                        <label class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="gender" value="2" @if ($user->gender == 'Perempuan') checked @endif>
                            <span class="form-check-label">Perempuan</span>
                        </label>
                          
                    </div>
                </div>
                
                <div class="form-group mb-3 row">
                    <label class="form-label col-3 col-form-label">Tanggal Lahir</label>
                    <div class="col">
                        <input type="date" class="form-control" name="tanggal_lahir" id="tanggal_lahir" value="{{ $user->tanggal_lahir }}">

                    </div>
                </div>
            
            </div>
        </div>
        <div class="btn-list">
            <a href="#" class="btn btn-secondary mr-1">Batal</a>
            <input type="submit" name="submit" value="Simpan" class="btn btn-success">
        </div>

    </div>

</form>
@endsection