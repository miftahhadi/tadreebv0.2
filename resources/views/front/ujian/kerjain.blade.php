@extends('layouts.front')

@section('page')
<div class="row d-flex justify-content-center">
    <div class="page-header mb-4">
    
        <h2 class="h1">{{ $exam->judul }}</h2>

    </div>
    <div class="col-md-7">
        <form action="{{ route('ujian.storeJawaban', ['kelas' => $kelas->id, 'slug' => $exam->slug, 'soal' => $soal->id]) }}" method="post">
        @csrf
            <div class="card" id="app">
                <div class="card-header">
                    Soal ke-{{ $nomorSoal }} dari {{ $totalSoal }}

                    <div class="card-action ml-auto">
                        <timer 
                            starttime="{{ $start }}"
                            endtime="{{ $end }}"
                            ></timer>
                    </div>
                </div>
                <div class="card-body">
                    {!! $soal->konten !!}

                    <div class="form-selectgroup form-selectgroup-boxes d-flex flex-column">

                        @foreach ($answers as $answer)
                        <label class="form-selectgroup-item flex-fill">
                            <input type="{{ $choice }}" 
                                name="jawaban[]" 
                                value="{{ $answer->id }}" 
                                class="form-selectgroup-input"
                                @foreach ($jawabanUser as $jwb)
                                    @if ($answer->id == $jwb['id']) checked @endif
                                @endforeach
                            >
                            <div class="form-selectgroup-label d-flex align-items-center p-3">
                                <div class="mr-3">
                                    <span class="form-selectgroup-check"></span>
                                </div>
                                <div>
                                    {!! $answer->redaksi !!}
                                </div>
                            </div>
                        </label>
                        @endforeach

                    </div>

                </div>
                <div class="card-footer">
                    <div class="btn-list">
                    
                        @if ($prevSoal)
                        <a href="{{ route('ujian.kerjain', ['kelas' => $kelas->id, 'slug' => $exam->slug, 'soal' => $prevSoal]) }}" class="btn btn-info">
                            <i class="fas fa-chevron-circle-left"></i>
                            <span class="ml-1">Sebelumnya</span>
                        </a>
                        @endif

                        <input type="submit" class="btn btn-success" value="Jawab">
                        
                        @if ($nextSoal)
                        <a href="{{ route('ujian.kerjain', ['kelas' => $kelas->id, 'slug' => $exam->slug, 'soal' => $nextSoal]) }}" class="btn btn-info">
                            <span class="mr-1">Selanjutnya</span> 
                            <i class="fas fa-chevron-circle-right"></i>
                        </a>
                        @else
                        <a href="{{ route('ujian.submitted') }}" class="btn btn-primary">
                            <span class="mr-1">Selesai</span> 
                            <i class="fas fa-check-circle"></i>
                        </a>
                        @endif 

                    </div>

                </div>
            </div>
        </form>
    </div>

    <div class="col-md-5">
        <div class="card">
            <div class="card-header">
                Direktori Soal
            </div>
            <div class="card-body">
                <div class="btn-list justify-content-center">
                @foreach ($exam->questions->all() as $key => $question)

                    <a href="{{ route('ujian.kerjain', [
                            'kelas' => $kelas->id,
                            'slug' => $exam->slug,
                            'soal' => $question->id
                            ]) }}" 
                        class="btn btn-light btn-sm @if (request('soal') == $question->id) active @endif ">
                        {{ ++$key }}
                    </a>
        
                @endforeach
                </div>

            </div>
        </div>

    </div>
</div>

<script type="text/javascript" src="/js/app.js"></script>
@endsection