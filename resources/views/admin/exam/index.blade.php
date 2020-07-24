@extends('layouts.admin')

@section('page')
<!-- Page Title and Stuffs -->
<div class="page-header">

    <div class="row align-items-center">
        <div class="col-auto">
            <h3 class="h1 my-0">Daftar Mata Ujian</h3>
        </div>   
        <div class="col-auto ml-auto">
            <!-- <a href="{{ route('exam.create') }}" class="btn btn-primary">
                <i class="fas fa-plus"></i> 
                <span class="ml-2">Tambah Baru</span>
            </a> -->

            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#tambahBaru">
                <i class="fas fa-plus"></i> 
                <span class="ml-2">Tambah Baru</span>
            </button>
        </div> 
    </div>

</div>
<!-- END Page Title and Stuffs -->
<!-- Data table -->
<div class="card">
    <table class="table card-table table-vcenter">
        <thead>
        <tr>
            <th width="5%">ID</th>
            <th>Mata Ujian</th>
            <th>Dibuat oleh</th>
            <th>Slug</th>
            <th></th>
        </tr>
        </thead>
        <tbody>

        @forelse($exams as $exam)
            <tr>
                <td>{{ $exam->id }}</td>
                <td>{{ $exam->judul }}</td>
                <td>{{ $exam->user->nama }}</td>
                <td>{{ $exam->slug }}</td>
                <td class="text-right">
                    <a href="{{ route('exam.show', ['exam' => $exam->id]) }}" class="btn bg-blue-lightest btn-xs" data-toggle="tooltip" title="Susun Ujian">Susun</a>
                    
                    <a href="{{ route('exam.edit', ['exam' => $exam->id]) }}" class="btn bg-blue-lightest btn-xs" data-toggle="tooltip" title="Edit">Edit</a>

                    <!-- Button modal trigger-->
                    <button type="button" class="btn btn-danger btn-xs" data-toggle="modal" data-id="" data-target="#hapusData"><i class="fe fe-trash-2" data-toggle="tooltip" title="Hapus"></i>Hapus</button>
                </td>
            </tr>
        @empty
            <tr>
                <td colspan="3" class="text-center">Belum ada mata ujian</td> 
            </tr>
        @endforelse      

        </tbody>
    </table>
</div>
<!-- END Data table -->

<!-- Modal Delete Data -->
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
<!-- END Modal Delete Data -->

<!-- Modal Add New -->
<div class="modal fade" id="tambahBaru" tabindex="-1" role="dialog" aria-labelledby="tambahBaruLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Ujian Baru</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <!-- SVG icon code -->
        </button>
      </div>
      <div class="modal-body" id="app">
          
        <item-baru-form judul="{{ $judul }}" item="{{ $item }}" action="{{ $action }}" url="{{ $url }}" slug="{{ $slug }}">
          @csrf
        </item-baru-form>
          
      </div>
    </div>
  </div>
</div>
<!-- END Modal Add New -->

<script type="text/javascript" src="/js/app.js"></script>
@endsection