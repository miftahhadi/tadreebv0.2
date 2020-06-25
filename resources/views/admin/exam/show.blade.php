@extends('layouts.admin')

@section('page')
<!-- Page Title and Stuffs -->
<ol class="breadcrumb" aria-label="breadcrumbs">
    <li class="breadcrumb-item"><a href="#">Dashboard</a></li>
    <li class="breadcrumb-item"><a href="#">Daftar Ujian</a></li>
    <li class="breadcrumb-item active" aria-current="page"><a href="#">Susun Ujian</a></li>
</ol>

<div class="row mt-3 mb-4">

    <h2 class="h1">{{ $exam->judul }}</h2>
    <span><strong>Deskripsi:</strong></span><span>{!! $exam->deskripsi !!}</span>
    <ul class="list-inline">
        <li class="list-inline-item"><a href="#">Edit</a></li>
        <li class="list-inline-item"><a href="#" class="text-danger">Hapus</a></li>
    </ul>
    
</div>
<!-- END Page Title and Stuffs -->
<div class="row mb-2">
    <div class="col-auto">
        <h2>Daftar Soal</h2>
    </div>    
    <div class="col-auto ml-auto">

        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#tambahSoal">
            <i class="fe fe-plus-circle"></i> Buat Soal Baru
        </button>  

    </div>
</div>

<div id="app">
    <div class="card">
        <div class="table-responsive">
            <table class="table table-vcenter card-table text-nowrap">
                <thead>
                    <tr>
                        <th class="w-1">No</th>
                        <th class="w-50">Soal</th>
                        <th>Tipe</th>
                        <th class="w-2"></th>
                    </tr>
                </thead>
                <tbody>

                    @forelse ($exam->questions as $key => $question)
                    <tr>
                        <td>{{ ++$key }}</td>
                        <td>{!! $question->konten !!}</td>
                        <td>{{ $question->tipe }}</td>
                        <td class="text-right">
                            <div class="btn-list flex-nowrap">
                                <show-question-button soal-id="{{ $question->id }}" exam-id="{{ $exam->id }}"></show-question-button>
                                <a href="{{ route('exam.question.show', ['exam' => $exam->id , 'soal' => $question->id]) }}" class="btn btn-light">Edit</a>
                                <a href="#" class="btn btn-danger" data-toggle="modal" data-target="#unlinkSoal">Buang</a>
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="3">Belum ada soal</td>
                    </tr>
                    @endforelse

                </tbody>
            </table>
        
        </div>
    </div>

<!-- Lihat soal -->
<!-- Modal -->
<div class="modal fade" id="showSoal" tabindex="-1" role="dialog" aria-labelledby="showSoalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="judulSoal">Soal ke </h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        ...
      </div>
      <div class="modal-footer">
      </div>
    </div>
  </div>
</div>

<!-- END Lihat soal -->


</div>
<!-- Tambah Soal -->
<div class="modal fade" id="tambahSoal" tabindex="-1" role="dialog" aria-labelledby="tambahSoalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <form action="/admin/ujian/{{ $exam->id }}/soal/create" method="get">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Pilih tipe soal</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                       <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-md" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z"></path><line x1="18" y1="6" x2="6" y2="18"></line><line x1="6" y1="6" x2="18" y2="18"></line></svg>
                    </button>
                </div>
                <div class="modal-body">

                    <div class="form-selectgroup form-selectgroup-boxes d-flex flex-column">

                        @foreach($questionTypes as $question)
                        <label class="form-selectgroup-item flex-fill">
                            <input type="radio" name="type" value="{{ $question['value'] }}" class="form-selectgroup-input" onclick="showChoices(this);">
                            <div class="form-selectgroup-label d-flex align-items-center p-3">
                                <div class="mr-3">
                                    <span class="form-selectgroup-check"></span>
                                </div>
                                <span class="form-selectgroup-label-content">
                                    <span>{{ $question['type'] }}</span>
                                </span>
                            </div>
                        </label>
                        @endforeach

                        <div class="mt-2">
                            <label for="choices" class="form-label">Jumlah pilihan</label>
                            <input type="number" class="form-control" name="choices" id="choices" value="4" disabled>
                        </div>

                    </div>
                    
                </div>
                <div class="modal-footer">
                    <input type="submit" class="col-md-3 btn btn-success" value="Tambah Soal">
                </div>
            </div>
        </form>
    </div>
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
<!-- END Tambah Soal -->

<!-- Unlink Soal -->
<div class="modal fade" id="unlinkSoal" tabindex="-1" role="dialog" aria-labelledby="unlinkSoalLabel" aria-hidden="true">
    
    <div class="modal-dialog modal-sm modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-body">
                <div class="modal-title">Apakah Anda yakin?</div>
                <div>Soal akan dihilangkan dari ujian/kuis ini, namun akan tetap ada di Bank Soal.</div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-link link-secondary mr-auto" data-dismiss="modal">Batal</button>
                <button type="button" class="btn btn-danger" data-dismiss="modal">Ya, lanjutkan</button>
            </div>
        </div>
    </div>

</div>
<!-- END Unlink Soal -->

<script type="text/javascript" src="/js/app.js"></script>
@endsection