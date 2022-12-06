@extends('layouts.app')
@section('content')
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h2>Deleted Vinyls</h2>
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
            <th>ID Vinyl</th>
            <th>Title</th>
            <th>Artist</th>
            <th>Genre</th>
            <th>Stats</th>
            <th>Stok</th>
            <th>ID Penjual</th>
            <th>ID Pembeli</th>
            <th width="280px">Action</th>
        </tr>
        @foreach ($vinyls as $vinyl)
        <tr>
            <td>{{ $vinyl->id_vinyl }}</td>
            <td>{{ $vinyl->title }}</td>
            <td>{{ $vinyl->artist }}</td>
            <td>{{ $vinyl->genre }}</td>
            <td>{{ $vinyl->stats }}</td>
            <td>{{ $vinyl->stok }}</td>
            <td>{{ $vinyl->id_penjual }}</td>
            <td>{{ $vinyl->id_pembeli }}</td>
            <td>
                <div class="d-flex gap-3">
                    <form class="m-0" id="restoreForm" action="/vinyls/trash/restore/{{$vinyl->id_vinyl}}" method="POST">
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
                                <form action="/vinyls/trash/forcedelete/{{$vinyl->id_vinyl}}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button class="btn btn-danger" type="submit">Yes</button>
                                </form>
                                
                            </div>
                        </div>
                    </div>
                </div>
                    <!-- <a class="btn btn-danger" onclick="return confirm('Are you sure?')" href="trash/{{ $vinyl->id_vinyl }}/forcedelete">Delete</a> -->
            </td>
        </tr>
        @endforeach
    </table>

@endsection

