@extends('front.classroom.main')

@section('classContent')
<!-- Pengampu -->
<div class="box mb-5">
    <div class="row my-2">
        <div class="col-auto">
            <h3 class="page-title">Guru Pengampu</h3>
        </div>

        @if (auth()->user()->isAdmin())
        <div class="col-auto ml-auto">
            <a href="#" class="btn btn-primary">Tambah Pengampu</a>
        </div>
        @endif
    </div>
        
    <div class="card">
        <table class="table card-table table-hover table-vcenter">
            <thead>        
                <tr>
                    <th>Nama</th>
                    <th>Username</th>
                </tr>
            </thead>
        <tbody>
            <tr>
                <td colspan="2">Belum ada pengampu</td>
            </tr>
        </tbody>
        </table>
    </div>
</div>
<!-- END Pengampu -->

<!-- Anggota -->
<div class="box">
    <div class="row mb-2">
        <div class="col-auto">
            <h3 class="page-title">Anggota Kelas</h3>
        </div>

        @if (auth()->user()->isAdmin() || auth()->user()->isTeacher())
        <div class="col-auto ml-auto">
            <a href="{{ route('kelas.anggota.tambah', ['kelas' => $kelas->id]) }}" class="btn btn-primary">
                Tambah Anggota
            </a>
        </div>
        @endif
    </div>

    <div class="card">
        <table class="table card-table table-hover table-vcenter">
            <thead>
            <tr>
                <th>Nama</th>
                <th>Username</th>
                <th>Email</th>
                <th></th>
            </tr>
            </thead>
            <tbody>
            @foreach ($users as $key=>$user)
                <tr>
                    <td>{{ $user->nama }}</td>
                    <td>{{ $user->username }}</td>
                    <td>{{ $user->email }}</td>
                    <td class="text-right"">
                        
                        <a href="#" class="btn btn-icon bg-blue-lightest" data-toggle="tooltip" title="Lihat Profil"><i class="fe fe-external-link"></i></a>
                        
                        <!-- Button modal trigger-->
                        <button type="button" class="btn btn-icon btn-danger" data-toggle="modal" data-id="" data-target="#hapusData"><i class="fe fe-user-x" data-toggle="tooltip" title="Keluarkan"></i></button>
                    </td>
                </tr>     
            @endforeach
            </tbody>
        </table>
    </div>
</div>

<!-- END Anggota -->

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