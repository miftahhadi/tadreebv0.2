@extends('layouts.admin')

@section('page')
<!-- Page Title and Stuffs -->
<div class="page-header">
    <div class="row">
        <div class="col-auto">
            <h3 class="h1 mt-0 mb-3">Periksa Data</h3>
        </div>
    </div>
</div>
<!-- END Page Title and Stuffs -->
<form action="{{ route('user.processImport') }}" method="post" class="row">
@csrf
    <input type="hidden" name="csv_data_file_id" value="{{ $csvDataFile->id }}">
    <div class="col-md-12">

        <div class="card">

            <div class="card-body">
                <p class="mb-1">Periksa data yang akan diimpor apakah sudah sesuai dengan urutan yang ada di sistem</p>
                
                <div class="table-responsive">
                    <table class="table table-vcenter">
                        <thead>
                            @foreach ($userField as $field)
                            <th>{{ $field }}</th>
                            @endforeach
                        </thead>
                        <tbody>

                            @foreach ($dataToShow as $row)
                            <tr>
                                @foreach ($row as $key => $value)
                                <td>{{ $value }}</td>
                                @endforeach
                            </tr>
                            @endforeach

                        </tbody>
                    </table>    
                </div>
            
            </div>
        </div>
        <div class="btn-list">
            <a href="{{ route('user.index') }}" class="btn btn-secondary mr-1">Batal</a>
            <input type="submit" name="submit" value="Simpan" class="btn btn-success">
        </div>

    </div>

</form>
@endsection