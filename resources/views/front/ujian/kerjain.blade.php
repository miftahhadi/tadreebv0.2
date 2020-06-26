@extends('layouts.front')

@section('page')
<div class="row d-flex justify-content-center">
    <div class="page-header mb-4">
    
        <h2 class="h1">{{ $exam->judul }}</h2>

    </div>
    <div class="col-md-7">
        <div class="card">
            <div class="card-header">
                Soal ke-{{ $nomorSoal }} dari {{ $totalSoal }}
            </div>
            <div class="card-body">
                {!! $soal->konten !!}

                <div class="form-selectgroup form-selectgroup-boxes d-flex flex-column">

                    @foreach ($answers as $answer)
                    <label class="form-selectgroup-item flex-fill">
                        <input type="{{ $choice }}" name="form-payment" value="visa" class="form-selectgroup-input">
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
                    <a href="#" class="btn btn-info">
                        <i class="fas fa-chevron-circle-left"></i>
                        <span class="ml-1">Sebelumnya</span>
                    </a>
                    @endif

                    <a href="#" class="btn btn-success">Jawab</a>
                    
                    @if ($nextSoal)
                    <a href="{{ route('ujian.kerjain', ['kelas' => $kelas->id, 'slug' => $exam->slug, 'soal' => $nextSoal]) }}" class="btn btn-info">
                        <span class="mr-1">Selanjutnya</span> 
                        <i class="fas fa-chevron-circle-right"></i>
                    </a>
                    @endif 

                </div>

            </div>
        </div>
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
                        class="btn btn-light btn-sm">
                        {{ ++$key }}
                    </a>
        
                @endforeach
                </div>

            </div>
        </div>

    </div>
</div>
@endsection