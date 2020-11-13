@extends('front.classroom.main')

@section('classContent')
<div class="row mb-2">
    <div class="col-md-8 align-middle">
        <h3 class="page-title">Ujian Terdaftar</h3>
    </div>

    @if (auth()->user()->isAdmin() || auth()->user()->isTeacher())
    <div class="col-md-4 text-right">
        <a href="{{ route('kelas.ujian.tambah', ['kelas' => $kelas->id]) }}" class="btn btn-primary">
            <i class="fas fa-plus"></i>
            <span class="ml-2">Tambah Ujian</span>
        </a>
    </div>
    @endif
</div>

<div class="card">
    <table class="table card-table table-vcenter">
        <thead>
        <tr>
            <th width="5%">ID</th>
            <th>Nama</th>
            <th></th>
        </tr>
        </thead>
        <tbody>
            @foreach ($exams as $key => $exam)
            <tr>
                <td>{{ ++$key }}</td>
                <td>{{ $exam->judul }}</td>
                <td class="text-right">
    
                    <a href="{{ route('ujian.info', ['kelas' => $kelas->id, 'exam' => $exam->slug]) }}" class="btn btn-icon bg-light" data-toggle="tooltip" title="Buka">Buka</a>

                    @if (auth()->user()->isAdmin() || auth()->user()->isTeacher())
                    <a href="{{ route('kelas.ujian.setting', ['kelas' => $kelas->id, 'ujian' => $exam->id]) }}" class="btn btn-icon bg-light" data-toggle="tooltip" title="Pengaturan">Pengaturan</a>

                    <a href="{{ route('ujian.hasil.showAll', ['kelas' => $kelas->id, 'exam' => $exam->slug]) }}" class="btn btn-icon bg-light" data-toggle="tooltip" title="Pengaturan">Hasil</a>
                    
                    <!-- Button modal trigger-->
                    <button type="button" class="btn btn-icon btn-danger" data-toggle="modal" data-id="" data-target="#hapusData">Buang</button>
                    @endif

                </td>
            </tr>     
            @endforeach

        </tbody>
    </table>
</div>
<!-- END Data table -->

<!-- Modal -->
<div class="modal fade" id="hapusData" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-body">
        Anda yakin ingin menghapus item ini?
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Tidak</button>
        <form action="delete.php" method="post">
          <input type="hidden" name="id" id="dataID">
          <input type="hidden" name="table" value="">
          <input type="hidden" name="primaryKey" value="">
          <input type="hidden" name="page" value="">
          <input type="submit" class="btn btn-danger" value="Hapus">
        </form>
      </div>
    </div>
  </div>
</div>

<script>
  $('#hapusData').on('show.bs.modal', function (event) {
  let button = $(event.relatedTarget) // Button that triggered the modal
  let id = button.data('id') // Extract info from data-* attributes
  // If necessary, you could initiate an AJAX request here (and then do the updating in a callback).
  // Update the modal's content. We'll use jQuery here, but you could use a data binding library or other methods instead.
  let modal = $(this)
  modal.find('.modal-footer #dataID').val(id)
  })
</script>

@endsection