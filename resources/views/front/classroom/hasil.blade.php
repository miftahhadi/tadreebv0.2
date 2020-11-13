@extends('front.classroom.main')

@section('classContent')
<div class="row mb-2">
    <div class="col-md-8 align-middle">
        Hasil Ujian
        <h3 class="page-title">{{ $exam->judul }}</h3>
    </div>

</div>

<div class="row pb-2">
    <div class="col btn-list">
        <a href="{{ route('ujian.hasil.showAll', ['kelas' => $kelas->id, 'exam' => $exam->slug]) }}" class="btn btn-primary btn-sm">Semua peserta</a>
        <a href="{{ route('ujian.hasil.showDone', ['kelas' => $kelas->id, 'exam' => $exam->slug]) }}" class="btn btn-primary btn-sm">Sudah mengerjakan</a>
        <a href="#" class="btn btn-primary btn-sm">Belum mengerjakan</a>
    </div>
</div>

<div class="card">
    <table class="table card-table table-vcenter">
        <thead>
        <tr>
            <th width="5%">No</th>
            <th>Username</th>
            <th>Nama</th>
            <th></th>
        </tr>
        </thead>
        <tbody>
        @foreach ($students as $key => $student)
            <tr>
                <td>{{ ++$key }}</td>
                <td>{{ $student->username }}</td>
                <td>{{ $student->nama }}</td>
                <td>
                    @if (in_array($student->id, $userDidExam)) 

                    <div class="text-success">
                        <i class="fas fa-check-circle"></i>    
                        <span class="ml-1">
                            Sudah Mengerjakan
                        </span>
                    </div>

                    @else
                    <div class="text-danger">
                        <i class="fas fa-times-circle"></i>    
                        <span class="ml-1">
                            Belum Mengerjakan
                        </span>
                    </div>
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