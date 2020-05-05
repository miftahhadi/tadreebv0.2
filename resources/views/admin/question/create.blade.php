@extends('layouts.admin')

@section('page')
<nav aria-label="breadcrumb">
  <ol class="breadcrumb">
    <li class="breadcrumb-item"><a href="/admin/ujian">Daftar Ujian</a></li>
    <li class="breadcrumb-item"><a href="/admin/ujian/{{ $exam->id }}">{{ $exam->judul }}</a></li>
  </ol>
</nav>
<form action="/admin/ujian/{{ $exam->id }}/soal" method="post">
@csrf

<div class="page-header">
    <h3 class="page-title">Soal Baru</h3>
    <div class="page-options">
        <input type="submit" value="Simpan" class="btn btn-success">
        <a href="#" class="btn btn-secondary">Batal</a>
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

        <textarea name="soal[konten]" id="redaksi" placeholder="Tuliskan soal..."></textarea>
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
                    <label class="custom-control custom-{{ $option }}">
                        <input type="{{ $option }}" class="custom-control-input" name="jawaban[{{ $i }}][benar]" value="1">
                        <span class="custom-control-label">Benar</span>
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
                <label class="custom-control custom-radio">
                    <input type="radio" class="custom-control-input" name="jawaban[1][benar]" value="1">
                    <input type="hidden" name="jawaban[1][redaksi]" value="{{ $value['benar'] }}">
                    <div class="custom-control-label">{{ $value['benar'] }}</div>
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
                <label class="custom-control custom-radio">
                    <input type="radio" class="custom-control-input" name="jawaban[2][benar]" value="1">
                    <input type="hidden" name="jawaban[2][redaksi]" value="{{ $value['salah'] }}">
                    <div class="custom-control-label">{{ $value['salah'] }}</div>
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