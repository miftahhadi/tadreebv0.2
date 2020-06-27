@extends('front.classroom.main')

@section('classContent')
<div class="row mb-2">
    <div class="col-md-8 align-middle">
        <h3 class="page-title">{{ $ujian->judul }}</h3>
    </div>
</div>
<form action="{{ route('kelas.ujian.saveSetting', ['kelas' => $kelas->id, 'ujian' => $ujian->id]) }}" method="post">
@csrf
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Pengaturan Ujian</h3>
        </div>
        
        <div class="card-body">
            
            <div class="form-group mb-3 row">
                <label class="form-label col-3 col-form-label">Tampilkan ujian?</label>
                <div class="col">
                    <div>
                        <label class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="tampil" value="1" @if ($ujian->pivot->tampil == 1) checked @endif>
                            <span class="form-check-label">Ya</span>
                        </label>
                        <label class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="tampil" value="0" @if ($ujian->pivot->tampil == 0) checked @endif>
                            <span class="form-check-label">Tidak</span>
                        </label>
                    </div>
                </div>
            </div>

            <div class="form-group mb-3 row">
                <label class="form-label col-3 col-form-label">Buka akses?</label>
                <div class="col">
                    <div>
                        <label class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="buka" value="1" @if ($ujian->pivot->buka == 1) checked @endif>
                            <span class="form-check-label">Buka</span>
                        </label>
                        <label class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="buka" value="0" @if ($ujian->pivot->buka == 0) checked @endif>
                            <span class="form-check-label">Tutup</span>
                        </label>
                    </div>
                </div>
            </div>

            <div class="form-group mb-3 row">
                <label class="form-label col-3 col-form-label">Buka hasil?</label>
                <div class="col">
                    <div>
                        <label class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="buka_hasil" value="1" @if ($ujian->pivot->buka_hasil == 1) checked @endif>
                            <span class="form-check-label">Buka</span>
                        </label>
                        <label class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="buka_hasil" value="0" @if ($ujian->pivot->buka_hasil == 0) checked @endif>
                            <span class="form-check-label">Tutup</span>
                        </label>
                    </div>
                </div>
            </div>

            <div class="form-group mb-3 row">
                <label class="form-label col-3 col-form-label">Tampilkan otomatis pada</label>
                <div class="col">
                    <div class="row">
                        <div class="col-auto">
                            <input type="date" class="form-control" name="tampil_otomatis[tanggal]" value="{{ $tampil_otomatis['tanggal'] ?? '' }}">
                        </div>
                        <div class="col-auto">
                            <input type="time" class="form-control" name="tampil_otomatis[waktu]" value="{{ $tampil_otomatis['waktu'] ?? '00:00' }}">
                        </div>
                    </div>
                    
                </div>
            </div>

            <div class="form-group mb-3 row">
                <label class="form-label col-3 col-form-label">Buka akses otomatis pada</label>
                <div class="col">
                    <div class="row">
                        <div class="col-auto">
                            <input type="date" class="form-control" name="buka_otomatis[tanggal]" value="{{ $buka_otomatis['tanggal'] ?? '' }}">
                        </div>
                        <div class="col-auto">
                            <input type="time" class="form-control" name="buka_otomatis[waktu]" value="{{ $buka_otomatis['waktu'] ?? '00:00' }}">
                        </div>
                    </div>
                    
                </div>
            </div>

            <div class="form-group mb-3 row">
                <label class="form-label col-3 col-form-label">Tutup akses otomatis pada</label>
                <div class="col">
                    <div class="row">
                        <div class="col-auto">
                            <input type="date" class="form-control" name="batas_buka[tanggal]" value="{{ $batas_buka['tanggal'] ?? '' }}">
                        </div>
                        <div class="col-auto">
                            <input type="time" class="form-control" name="batas_buka[waktu]" value="{{ $batas_buka['waktu'] ?? '00:00' }}">
                        </div>
                    </div>
                    
                </div>
            </div>

            <div class="form-group mb-3 row">
                <label class="form-label col-3 col-form-label">Durasi</label>
                <div class="col-auto">

                    <input type="number" class="form-control" name="durasi" value="{{ $ujian->pivot->durasi ?? 0 }}">
                    
                </div>
            </div>

            <div class="form-group mb-3 row">
                <label class="form-label col-3 col-form-label">Kesempatan mencoba</label>
                <div class="col-auto">

                    <input type="number" class="form-control" name="attempt" value="{{ $ujian->pivot->attempt ?? 0 }}">
                    
                </div>
            </div>

            <div class="form-footer">
                <input type="submit" value="Simpan" class="btn btn-success">
            </div>


        </div>

    </div>
</form>
<!-- END Data table -->

@endsection