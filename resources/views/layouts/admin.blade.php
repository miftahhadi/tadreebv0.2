@extends('layouts.basic')
    
    @section('header-nav')
    <div class="header py-4">
        <div class="container">
            <div class="d-flex">
                <a class="header-brand" href="/home">
                <img src="/assets/images/tabler.svg" class="header-brand-img" alt="tabler logo">
                </a>
                <div class="d-flex order-lg-2 ml-auto">
                    <div class="dropdown">
                        <a href="#" class="nav-link pr-0 leading-none" data-toggle="dropdown">
                            <span class="avatar" style="background-image: url(./demo/faces/female/25.jpg)"></span>
                            <span class="ml-2 d-none d-lg-block">
                                <span class="text-default">Jane Pearson</span>
                                <small class="text-muted d-block mt-1">Administrator</small>
                            </span>
                        </a>
                        <div class="dropdown-menu dropdown-menu-right dropdown-menu-arrow">
                            <a class="dropdown-item" href="#">
                                <i class="dropdown-icon fe fe-user"></i> Profile
                            </a>
                            <a class="dropdown-item" href="#">
                                <i class="dropdown-icon fe fe-settings"></i> Settings
                            </a>
                            <a class="dropdown-item" href="#">
                                <span class="float-right"><span class="badge badge-primary">6</span></span>
                                <i class="dropdown-icon fe fe-mail"></i> Inbox
                            </a>
                            <a class="dropdown-item" href="#">
                                <i class="dropdown-icon fe fe-send"></i> Message
                            </a>
                            <div class="dropdown-divider"></div>
                            <a class="dropdown-item" href="#">
                                <i class="dropdown-icon fe fe-help-circle"></i> Need help?
                            </a>
                            <a class="dropdown-item" href="#">
                                <i class="dropdown-icon fe fe-log-out"></i> Sign out
                            </a>
                        </div>
                    </div>
                </div>
                <a href="#" class="header-toggler d-lg-none ml-3 ml-lg-0" data-toggle="collapse" data-target="#headerMenuCollapse">
                    <span class="header-toggler-icon"></span>
                </a>
            </div>
        </div>
    </div>
    <div class="header collapse d-lg-flex p-0" id="headerMenuCollapse">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg order-lg-first">
                    <ul class="nav nav-tabs border-0 flex-column flex-lg-row">
                        <li class="nav-item">
                            <a href="/admin" class="nav-link"><i class="fe fe-home"></i> Home</a>
                        </li>
                        <li class="nav-item">
                            <a href="/admin/pelajaran" class="nav-link"><i class="fe fe-cpu"></i> Pelajaran</a>
                        </li>
                        <li class="nav-item">
                            <a href="/admin/ujian" class="nav-link"><i class="fe fe-box"></i> Ujian</a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
    @endsection

    @section('content')
    <div class="my-3 my-md-3">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-9">

                    @yield('page')
            
                </div>
            </div>
        </div>
    </div>
    @endsection

@section('footer')
<footer class="footer">
    <div class="container">
        <div class="row align-items-center flex-row-reverse">
            <div class="col-12 col-lg-auto mt-3 mt-lg-0 text-center">
                Copyright © 2019 <a href=".">Tabler</a>. Theme by <a href="https://codecalm.net" target="_blank">codecalm.net</a> All rights reserved.
            </div>
        </div>
    </div>
</footer>
@endsection