@extends('front.classroom.main')

@section('classContent')
<div class="row mb-2">
    <div class="col-md-8 align-middle">
        <h4>Ujian Terdaftar</h4>
    </div>
    <div class="col-md-4 text-right">
        <a href="{{ route('kelas.pelajaran.tambah', ['kelas' => $kelas->id]) }}" class="btn btn-square btn-secondary ml-auto"><i class="fa fa-plus-square"></i> Tambah Pelajaran</a>
    </div>
</div>


<div class="card">
    <table class="table card-table table-hover table-vcenter">
        <thead>
        <tr>
            <th width="5%">ID</th>
            <th>Nama</th>
            <th>Kategori</th>
            <th></th>
        </tr>
        </thead>
        <tbody>

            <tr>
                <td>1</td>
                <td>Nahwu Dasar</td>
                <td>Dasar</td>
                <td class="text-right"">
                    
                    <a href="#" class="btn btn-icon bg-blue-lightest" data-toggle="tooltip" title="Lihat Profil"><i class="fe fe-external-link"></i></a>
                    
                    <!-- Button modal trigger-->
                    <button type="button" class="btn btn-icon btn-danger" data-toggle="modal" data-id="" data-target="#hapusData"><i class="fe fe-user-x" data-toggle="tooltip" title="Keluarkan"></i></button>
                </td>
            </tr>     

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