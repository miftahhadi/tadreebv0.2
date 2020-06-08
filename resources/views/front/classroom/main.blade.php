@extends('layouts.admin')

@section('page')
<!-- Classroom header -->
<div class="card">
    <div class="card-body">
        {{ $kelas->group->nama }}
        <h2>{{ $kelas->nama }}</h2>
    </div>
    <div class="card-footer">
        <ul class="nav nav-pills justify-content-center">
        @foreach ($kelas->pages() as $page)
            <li class="nav-item">
                <a href="{{ $page['link'] }}" class="nav-link @if (strpos(url()->current(), strtolower($page['title']))) active @endif">{{ $page['title'] }}</a>
            </li>
        @endforeach
        </ul>
    </div>
</div>
<!-- Classroom header -->

@yield('classContent')

@endsection