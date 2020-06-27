@extends('layouts.basic')
    
    @section('header-nav')

    <header class="navbar navbar-expand-md navbar-light">
        <div class="container-xl">
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbar-menu">
                <span class="navbar-toggler-icon"></span>
            </button>
            <a href="{{ route('main.index') }}" class="navbar-brand navbar-brand-autodark d-none-navbar-horizontal pr-0 pr-md-3">
                <img src="/assets/img/logo.png" alt="Portal MUBK" class="navbar-brand-image mr-2">
                <h2>Portal Ma'had Umar bin Khattab</h3>
            </a>
            <div class="navbar-nav flex-row order-md-last">
            
                <div class="nav-item dropdown">
                    <a href="#" class="nav-link d-flex lh-1 text-reset p-0" data-toggle="dropdown">
                        <span class="avatar">
                            <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-md" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z"></path><circle cx="12" cy="7" r="4"></circle><path d="M5.5 21v-2a4 4 0 0 1 4 -4h5a4 4 0 0 1 4 4v2"></path></svg>
                        </span>
                        <div class="d-none d-xl-block pl-2">
                            <div>{{ auth()->user()->nama }}</div>
                            <div class="mt-1 small text-muted">{{ auth()->user()->roles->last()->tipe}}</div>
                        </div>
                    </a>
                    <div class="dropdown-menu dropdown-menu-right">
                    <a class="dropdown-item" href="#">
                        Profil
                    </a>
                    
                    <div class="dropdown-divider"></div>
                        <a class="dropdown-item" href="{{ route('logout') }}">
                            Keluar
                        </a>
                    </div>
                </div>
            </div>
            <div class="collapse navbar-collapse" id="navbar-menu">
                <div class="d-flex flex-column flex-md-row flex-fill align-items-stretch align-items-md-center">
                    
                    <div class="ml-md-auto pl-md-4 py-2 py-md-0 mr-md-4 order-first order-md-last flex-grow-1 flex-md-grow-0">
                        <ul class="navbar-nav">
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('main.index') }}" >
                                    <span class="nav-link-title">
                                        Beranda
                                    </span>
                                </a>
                            </li>

                            <li class="nav-item">
                                <a class="nav-link" href="#" >
                                    <span class="nav-link-title">
                                        Ujian
                                    </span>
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </header>
      
    @endsection

    @section('content')
    <div class="content">
        <div class="container-xl">
            @yield('page')
        </div>
    </div>
    @endsection