@extends('layouts.admin')

@section('page')
<ol class="breadcrumb" aria-label="breadcrumbs">
    <li class="breadcrumb-item"><a href="#">Dashboard</a></li>
    <li class="breadcrumb-item"><a href="#">Daftar Ujian</a></li>
    <li class="breadcrumb-item"><a href="#">{{ $exam->judul }}</a></li>
    <li class="breadcrumb-item active" aria-current="page"><a href="#">Buat Soal Baru</a></li>
</ol>

<form action="/admin/ujian/{{ $exam->id }}/soal" method="post">
@csrf

<div class="row mt-3 mb-4">
    <div class="col-auto">
        <h2 class="h1">Soal Baru</h2>
    </div>
    
    <div class="col-auto ml-auto">
        <input type="submit" value="Simpan" class="btn btn-success">
        <a href="{{ route('exam.show', ['exam' => $exam->id]) }}" class="btn btn-white">Batal</a>
    </div>
</div>

<div class="card">
    <div class="card-header">
        Redaksi Soal
    </div>
    <div class="card-body">

        @error('soal[konten]')
        <small class="text-danger">Soal belum diisi</small>
        @enderror

        <textarea class="form-control" name="soal[konten]" id="redaksi" placeholder="Tuliskan soal..."></textarea>
    </div>
</div>

@if(request('type') == 'multiple' || request('type') == 'single')
<input type="hidden" name="soal[tipe]" value="{{ request('type') == 'single' ? 1 : 2 }}">

<h4 class="card-title">Pilihan Jawaban</h4>

@for($i = 0; $i < $choices; $i++)

<div class="card">
    <div class="card-header">
      Pilihan {{ $i + 1 }}
    </div>
    <div class="card-body" id="cardSoal">
        <textarea name="jawaban[{{ $i }}][redaksi]"></textarea>
    </div> 
    
    <div class="card-footer">
        <div class="row">
            <div class="col-md-2">
                <div class="form-group">
                    <div class="form-label">Pilihan Benar</div>
                    <label class="form-check">
                        <input type="{{ $option }}" class="form-check-input" name="jawaban[{{ $i }}][benar]" value="1">
                        <span class="form-check-label">Benar</span>
                    </label>
                </div>
            </div>

            <div class="col-md-3">
                <div class="form-group">
                    <label class="form-label">Nilai</label>
                    <input type="number" class="form-control" name="jawaban[{{ $i }}][nilai]" placeholder="Nilai" value="0">
                </div>
            </div>  

        </div>
    </div>

</div>
@endfor

@elseif(request('type') == 'benarsalah' || request('type') == 'benarsalahArabic')
<input type="hidden" name="soal[tipe]" value="3">
<h4 class="card-title">Pilihan Jawaban</h4>
<div class="row">
    <div class="col-md-6">
        <div class="card">
            <div class="card-body">
                <label class="form-check">
                    <input type="radio" class="form-check-input" name="jawaban[1][benar]" value="1">
                    <input type="hidden" name="jawaban[1][redaksi]" value="{{ $value['benar'] }}">
                    <div class="form-check-label">{{ $value['benar'] }}</div>
                </label>
            </div>

            <div class="card-footer">

                <div class="form-group">
                    <label class="form-label">Nilai</label>
                    <input type="number" class="form-control" placeholder="Nilai" value="0" name="jawaban[1][nilai]">
                </div>
 
            </div>

        </div>
    </div>

    <div class="col-md-6">
        <div class="card">
            <div class="card-body">
                <label class="form-check">
                    <input type="radio" class="form-check-input" name="jawaban[2][benar]" value="1">
                    <input type="hidden" name="jawaban[2][redaksi]" value="{{ $value['salah'] }}">
                    <div class="form-check-label">{{ $value['salah'] }}</div>
                </label>
            </div>

            <div class="card-footer">
                
                <div class="form-group">
                    <label class="form-label">Nilai</label>
                    <input type="number" class="form-control" placeholder="Nilai" value="0" name="jawaban[2][nilai]">
                </div>

            </div>

        </div>
    </div>
</div>

@elseif(request('type') == 'text')
<input type="hidden" name="soal[tipe]" value="4">
@endif

</form>
@endsection