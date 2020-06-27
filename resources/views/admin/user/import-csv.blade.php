@extends('layouts.admin')

@section('page')
<!-- Page Title and Stuffs -->
<div class="page-header">
    <div class="row">
        <div class="col-auto">
            <h3 class="h1 mt-0 mb-3">Impor User dari File CSV</h3>
        </div>
    </div>
</div>
<!-- END Page Title and Stuffs -->
<form action="{{ route('user.parseCsv') }}" method="post" class="row" enctype="multipart/form-data">
@csrf
    <div class="col-md-10">

        <div class="card">

            <div class="card-body">
                <p>Di sini, Anda bisa mengimpor user secara massal. Data user yang akan diimpor harus Anda simpan dalam file berekstensi .CSV dan harus sesuai urutan berikut</p>

                <div class="table-responsive">
                    <table class="table table-vcenter">
                        <thead>
                            @foreach ($userField as $field)
                            <th>{{ $field }}</th>
                            @endforeach
                        </thead>
                        <tbody>
                            <tr>
                            
                            </tr>
                        </tbody>
                        
                    </table>
                </div>

                <p><strong>Perhatian:</strong> Sistem menganggap baris pertama dari file CSV yang diimpor sebagai header sehingga akan melewati baris pertama ini dan tidak menyimpannya ke database</p>

                <br>

                <span>Pilih File</span>            
                <div class="form-file">
                    <input type="file" id="csv_file" name="csv_file" accept="text/csv">
                    
                </div>
                @error('csv_file')
                <span class="invalid-feedback">{{ $message }}</span>
                @enderror

            </div>
        </div>
        <div class="btn-list">
            <a href="{{ route('user.index') }}" class="btn btn-secondary mr-1">Batal</a>
            <input type="submit" name="submit" value="Upload" class="btn btn-success">
        </div>

    </div>

</form>
@endsection