@extends('layouts.admin')

@section('page')
<!-- Page Title and Stuffs -->
<div class="row mt-5">
  <h2>{{ $exam->judul }}</h2>
</div>
<div class="row">
  {!! $exam->deskripsi !!}
</div>

<!-- END Page Title and Stuffs -->
<!-- Tambah soal -->
<div class="row">
  <button class="btn btn-primary" type="button" data-toggle="collapse" data-target="#pilihanSoal" aria-expanded="false" aria-controls="pilihanSoal">
    <i class="fe fe-plus-circle"></i> Tambah Soal
  </button>
  <a href="/admin/ujian/{{ $exam->id }}/soal/create?type=text" class="btn btn-primary ml-1"><i class="fe fe-folder"></i> Tambah Teks</a>
</div>

<div class="collapse my-2" id="pilihanSoal">
  <form action="/admin/ujian/{{ $exam->id }}/soal/create" method="get">
    <div class="row">
      <div class="card card-body">
        <p>Pilih tipe soal</p>
        <div class="row">
          <div class="col-md-6">
            <fieldset class="form-fieldset">
              <label class="custom-control custom-radio">
                <input type="radio" class="custom-control-input" name="type" value="multiple" onclick="showChoices(this);">
                <div class="custom-control-label">Jawaban Ganda</div>
              </label>
              <label class="custom-control custom-radio">
                <input type="radio" class="custom-control-input" name="type" value="single" onclick="showChoices(this);">
                <div class="custom-control-label">Pilihan Ganda</div>
              </label>
              <div class="form-group">
                <label class="form-label">Jumlah pilihan</label>
                <input type="number" class="form-control mt-3" name="choices" id="choices" placeholder="Masukkan jumlah pilihan jawaban..." disabled>
              </div>
            </fieldset>
          </div>
          <div class="col-md-6">
            <fieldset class="form-fieldset">
            <div class="form-group">
                <div class="custom-controls-stacked">
                  <label class="custom-control custom-radio">
                    <input type="radio" class="custom-control-input" name="type" value="benarsalah" onclick="showChoices(this);">
                    <div class="custom-control-label">Benar/Salah</div>
                  </label>
                  <label class="custom-control custom-radio">
                    <input type="radio" class="custom-control-input" name="type" value="benarsalahArabic" onclick="showChoices(this);">
                    <div class="custom-control-label">صحيح/خطأ</div>
                  </label>
                </div>
              </div>
            </fieldset>
          </div>
        </div>
        <input type="submit" class="col-md-3 btn btn-success" value="Tambah Soal">
      </div>
    </div>
  </form>
</div>

<script>
function showChoices(that) {
  if (that.value == "multiple" || that.value == "single") {
    document.getElementById("choices").disabled = false;
  } else {
    document.getElementById("choices").disabled = true;
  }
}
</script>
<!-- END Tambah soal -->

<div class="row mt-8 border-bottom">
  <h3>Daftar Soal</h3>
</div>

<div class="row mt-4">

@foreach ($exam->questions as $question)
  <div class="card">
    <div class="card-header">
      Soal ke-{{ $question->pivot->urutan }}
      <div class="card-options">
        <a href="#" class="text-muted"><i class="fe fe-more-vertical"></i></a>
      </div>
    </div>
    <div class="card-body">
       {!! $question->konten !!}
    </div>
    <table class="table card-table table-vcenter">
      <tbody>

      @foreach ($question->answers as $answer)
        <tr>
          <td class="w-1 @if ($answer->benar == 1) text-success @else text-danger @endif"><i class="fa @if ($answer->benar == 1) fa-check-circle @else fa-times-circle @endif"></i></td>
          <td>{!! $answer->redaksi !!}</td>
          <td class="text-right">Nilai: {{ $answer->nilai }}</td>
        </tr>
      @endforeach

      </tbody>
    </table>
  </div>

@endforeach


</div>

@endsection