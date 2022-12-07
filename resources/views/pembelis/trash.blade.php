@extends('layouts.app')
@section('content')
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h2>Deleted Pembeli</h2>
            </div>
        </div>
    </div>
    @if ($message = Session::get('success'))
        <div class="alert alert-success">
            <p>{{ $message }}</p>
        </div>
    @endif
    <table class="table table-bordered">
        <tr>
            <th>ID Pembeli</th>
            <th>Nama Pembeli</th>
            <th>No Telp</th>
            <th>Alamat pembeli</th>
            <th>ID vinyl</th>
            <th width="280px">Action</th>
        </tr>
        @foreach ($pembelis as $pembeli)
        <tr>
            <td>{{ $pembeli->id_pembeli }}</td>
            <td>{{ $pembeli->nama_pembeli }}</td>
            <td>{{ $pembeli->no_telp }}</td>
            <td>{{ $pembeli->alamat_pembeli }}</td>
            <td>{{ $pembeli->id_vinyl }}</td>
            <td>
                <div class="d-flex gap-3">
                    <form class="m-0" id="restoreForm" action="/pembelis/trash/restore/{{$pembeli->id_pembeli}}" method="POST">
                        @csrf
                         <button class="btn btn-info" type="submit">Restore</button>
                    </form>
                    
                    <!-- Button trigger modal -->
                    <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#hapusModal">
                    Delete
                    </button>
                </div>
                    

                   
                <!-- Modal -->
                <div class="modal fade" id="hapusModal" tabindex="-1" aria-labelledby="hapusModalLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="hapusModalLabel">Confirmation</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                Are you sure you want to permanently delete this data?
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">No</button>
                                <form action="/pembelis/trash/forcedelete/{{$pembeli->id_pembeli}}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button class="btn btn-danger" type="submit">Yes</button>
                                </form>
                                
                            </div>
                        </div>
                    </div>
                </div>
                    <!-- <a class="btn btn-danger" onclick="return confirm('Are you sure?')" href="trash/{{ $pembeli->id_pembeli }}/forcedelete">Delete</a> -->
            </td>
        </tr>
        @endforeach
    </table>

@endsection

