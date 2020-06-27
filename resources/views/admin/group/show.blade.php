@extends('layouts.admin')

@section('page')
<!-- Page Title and Stuffs -->
<div class="page-header">

    <div class="row align-items-center">
        <div class="col-auto">
            <span class="page-description">Grup User</span>
            <h3 class="h1 my-0">{{ $grup->nama }}</h3>
        </div>   
        <div class="col-auto ml-auto">
            <a href="{{ route('group.classroom.create', ['grup' => $grup->id]) }}" class="btn btn-primary">
                <i class="fas fa-plus"></i> 
                <span class="ml-2">Tambah Baru</span>
            </a>
        </div> 
    </div>

</div>
<!-- END Page Title and Stuffs -->
<!-- Data table -->
<div class="card">
    <table class="table card-table table-hover table-vcenter">
        <thead>
        <tr>
            <th width="5%">ID</th>
            <th>Nama Kelas</th>
            <th>Pengampu</th>
            <th></th>
        </tr>
        </thead>
        <tbody>

        @forelse($classrooms as $classroom)
            <tr>
                <td>{{ $classroom->id }}</td>
                <td>{{ $classroom->nama }}</td>
                <td>{{ $classroom->user ?? 'Belum ada pengampu' }}</td>
                <td>
                    <div class="text-right">

                        <a href="{{ route('kelas.anggota', ['kelas' => $classroom->id]) }}" class="btn btn-icon bg-light">Anggota</i></a>

                        <a href="{{ route('kelas.pelajaran', ['kelas' => $classroom->id]) }}" class="btn btn-icon bg-light">Pelajaran</a>

                        <a href="{{ route('kelas.ujian', ['kelas' => $classroom->id]) }}" class="btn btn-icon bg-light">Ujian</a>

                        <a href="#" class="btn btn-icon bg-light">Edit</a>
                        
                        <!-- Button modal trigger-->
                        <button type="button" class="btn btn-icon btn-danger" data-toggle="modal" data-id="" data-target="#hapusData">Hapus</button>

                    </div>
                    
                </td>
            </tr>
        @empty
            <tr>
                <td colspan="3" class="text-center">Belum ada kelas dalam grup ini</td> 
            </tr>
        @endforelse      

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