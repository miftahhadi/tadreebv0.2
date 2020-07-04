@extends('layouts.front')

@section('page')
<div class="row d-flex justify-content-center">

    <div class="col-md-9">
        <div class="mb-4">
            
            <h3>Hasil Ujian</h3>
            <h2 class="h1">{{ $exam->judul }}</h2>

        </div>

        <div class="row row-deck">
            <div class="col">
                <div class="card">
                    <div class="card-body">
                        <div class="row row-sm align-items-center">
                            <div class="col-auto">
                                <span class="avatar avatar-md"><i class="fas fa-user-graduate"></i></span>
                            </div>
                            <div class="col">
                                <h3 class="mb-0">{{ $user->nama }}</h3>
                                <div class="text-muted">{{ $user->username}}</div>
                            </div>
                        </div>
                        <div class="row align-items-center mt-4">
                            <div class="col">
                                <div>
                                    <div class="d-flex mb-1 align-items-center lh-1">
                                        <div class="font-weight-bolder m-0">Waktu Mengerjakan: {{ $dataSubmit->pivot->waktu_mulai }}</div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col ml-auto">
                <div class="card">
                    <div class="card-body">
                        <h3 class="mb-0">Nilai Peserta</h3>
                        <h2 class="mb-3">
                            @if ($bukaKunci == 1)
                            {{ $nilaiUser }}
                            @else
                            Kunci jawaban belum dibuka
                            @endif
                        </h2>
                        <h4>Nilai total ujian: {{ $nilaiUjian }}</h4>
                    </div>
                </div>
                
            </div>
        </div>

        @foreach ($exam->questions as $key => $soal)
        <div class="card">
            <div class="card-header">
                Soal ke-{{ ++$key }} dari {{ $jumlahSoal }} 

            </div>
            <div class="card-body">
                {!! $soal->konten !!}

                <div class="form-selectgroup form-selectgroup-boxes d-flex flex-column">

                    @foreach ($soal->answers as $answer)
                    <label class="form-selectgroup-item flex-fill">
                        <input type="{{ $choice[$soal->id] }}" 
                            value="{{ $answer->id }}" 
                            class="form-selectgroup-input"
                            @if (in_array($answer->id, $jawabanUser[$soal->id]))
                            checked
                            @endif
                            disabled> 

                        <div class="form-selectgroup-label d-flex align-items-center p-3">
                            <div class="mr-3">
                                <span class="form-selectgroup-check"></span>
                            </div>
                            <div>
                                {!! $answer->redaksi !!}
                            </div>
                            @if ($bukaKunci == 1)
                            <div class="ml-auto">
                                Nilai: {{ $answer->nilai }}
                            </div>
                            @endif
                        </div>
                    </label>
                    @endforeach

                </div>

            </div>
            <div class="card-footer">
            
            </div>
        </div>
        @endforeach

    </div>

</div>

@endsection