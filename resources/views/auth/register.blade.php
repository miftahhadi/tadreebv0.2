@extends('layouts.auth')

@section('content')
<div class="page-single">
    <div class="container">
        <div class="row">
            <div class="col col-login mx-auto">
                <div class="text-center mb-6">
                    <img src="/assets/images/tabler.svg" class="h-6" alt="">
                </div>
                <form class="card" action="{{ route('register') }}" method="post">
                @csrf
                <div class="card-body p-6">
                    <div class="card-title">Create new account</div>
                    <div class="form-group">
                        <label class="form-label">Nama</label>
                        
                        <input type="text" class="form-control @error('nama') is-invalid @enderror" name="nama" value="{{ old('nama') }}" placeholder="Enter name">

                        @error('name')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    
                    </div>
                    
                    <div class="form-group">
                        <label class="form-label">Username</label>
                        
                        <input type="text" class="form-control @error('username') is-invalid @enderror" name="username" value="{{ old('username') }}" required placeholder="Enter username">

                        @error('username')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror

                    </div>

                    <div class="form-group">
                        <label class="form-label">Email</label>
                        
                        <input type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" placeholder="Enter email">

                        @error('email')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror

                    </div>
                
                    <div class="form-group">
                        <label for="password" class="form-label">Password</label>

                        <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password" placeholder="Password">

                        @error('password')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror

                    </div>
                

                    <div class="form-group">
                        <label for="password-confirm" class="form-label">{{ __('Confirm Password') }}</label>


                        <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">
                    
                    </div>
                    
                    <div class="form-footer">
                        <button type="submit" class="btn btn-primary btn-block">Create new account</button>
                    </div>
                </div>
            </form>
            <div class="text-center text-muted">
                Already have account? <a href="/login">Sign in</a>
            </div>
        </div>
    </div>
</div>
@endsection
