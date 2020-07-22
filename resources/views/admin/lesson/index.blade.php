@extends('layouts.admin')

@section('page')
<!-- Page Title and Stuffs -->
<div class="page-header">

    <div class="row align-items-center">
        <div class="col-auto">
            <h3 class="h1 my-0">Mata Pelajaran</h3>
        </div>   
        <div class="col-auto ml-auto">
            <!-- <a href="{{ route('lesson.create') }}" class="btn btn-primary">
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
<div class="row">
    <div class="col">

        <div class="card">
            <table class="table card-table table-hover table-vcenter">
                <thead>
                <tr>
                    <th width="5%">#</th>
                    <th>Mata Pelajaran</th>
                    <th width="23%"></th>
                </tr>
                </thead>
                <tbody>

                @forelse($lessons as $key => $lesson)
                    <tr>
                        <td>{{ ++$key }}</td>
                        <td>{{ $lesson->judul }}</td>
                        <td>

                            <div class="btn-list">

                                <a href="#" class="btn btn-link" aria-label="Button">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-md" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z"></path><path d="M5 4h14a1 1 0 0 1 1 1v5a1 1 0 0 1 -1 1h-7a1 1 0 0 0 -1 1v7a1 1 0 0 1 -1 1h-5a1 1 0 0 1 -1 -1v-14a1 1 0 0 1 1 -1"></path><line x1="4" y1="8" x2="6" y2="8"></line><line x1="4" y1="12" x2="7" y2="12"></line><line x1="4" y1="16" x2="6" y2="16"></line><line x1="8" y1="4" x2="8" y2="6"></line><polyline points="12 4 12 7 "></polyline><polyline points="16 4 16 6 "></polyline></svg>
                                </a>
                                <a href="#" class="btn btn-link" aria-label="Button">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-md" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z"></path><path d="M9 7 h-3a2 2 0 0 0 -2 2v9a2 2 0 0 0 2 2h9a2 2 0 0 0 2 -2v-3"></path><path d="M9 15h3l8.5 -8.5a1.5 1.5 0 0 0 -3 -3l-8.5 8.5v3"></path><line x1="16" y1="5" x2="19" y2="8"></line></svg>
                                </a>
                                <a href="#" class="btn btn-link" aria-label="Button">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-md" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z"></path><line x1="4" y1="7" x2="20" y2="7"></line><line x1="10" y1="11" x2="10" y2="17"></line><line x1="14" y1="11" x2="14" y2="17"></line><path d="M5 7l1 12a2 2 0 0 0 2 2h8a2 2 0 0 0 2 -2l1 -12"></path><path d="M9 7v-3a1 1 0 0 1 1 -1h4a1 1 0 0 1 1 1v3"></path></svg>
                                </a>
  
                            </div>
                    
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="3" class="text-center">Belum ada pelajaran</td> 
                    </tr>
                @endforelse      

                </tbody>
            </table>
        </div>
    </div>
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

<!-- Modal Add New -->
<div class="modal fade" id="tambahBaru" tabindex="-1" role="dialog" aria-labelledby="tambahBaruLabel" aria-hidden="true">
<div class="modal-dialog modal-lg" role="document">
  <div class="modal-content">
    <div class="modal-header">
      <h5 class="modal-title">Pelajaran Baru</h5>
      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
        <!-- SVG icon code -->
      </button>
    </div>
    <div class="modal-body" id="app">
        <form action="" method="post">
        @csrf
            <item-baru-form></item-baru-form>
        </form>
    </div>

    <div class="modal-footer">
    
      <a href="#" class="btn btn-secondary" data-dismiss="modal">
        Batal
      </a>
      <input type="submit" name="submit" value="Simpan" class="btn btn-success">

      </a>
    </div>
  </div>
</div>
</div>


<!-- END Modal Add New -->

<script type="text/javascript" src="/js/app.js"></script>
@endsection