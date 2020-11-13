@extends('layouts.front')

@section('page')
<div class="row d-flex justify-content-center pt-5">

    <div class="col-md-10">

        <h2 class="display-5 font-weight-bold">Marhaban, {{ auth()->user()->nama }}</h2>

        <br>

        <h3 class="h1">Ujian Anda</h3>
        <hr class="hr mt-3">

        <div class="row row-deck">

        @foreach ($daftarKelas as $kelas)
            @foreach ($kelas->exams as $exam)
            @if ($exam->pivot->tampil == 1)
            <div class="col-lg-4 col-md-6">

                <div class="card">
                    <div class="card-body">
                        <div class="row align-items-center">

                            <div class="col-auto m-0">
                                <span class="bg-primary text-white stamp p-0">
                                    <i class="fas fa-file-alt"></i>
                                </span>
                            </div>

                            <div class="col">
                                <a href="{{ route('ujian.info', ['kelas' => $kelas->id, 'exam' => $exam->slug]) }}" class="stretched-link"><h3 class="m-0">{{ $exam->judul }}</h3></a>

                                @if ($exam->pivot->buka == 1)
                                <span class="badge bg-success">Terbuka</span>
                                @else
                                <span class="badge bg-danger">Tertutup</span>
                                @endif

                            </div>     
                                                    
                        </div>
                                            
                    </div>

                    <div class="card-footer">
                        Kelas: {{ $kelas->nama }}
                    </div>
                </div>

            </div>   
            @endif         

            @endforeach
        @endforeach              
            
        </div>

    </div>

</div>

@endsection