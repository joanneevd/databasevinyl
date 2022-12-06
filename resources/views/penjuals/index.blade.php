@extends('layouts.app')
@section('content')
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h2>Penjual</h2>
            </div>
            <div class="pull-right">
                @can('penjual-create')
                <a class="btn btn-success" href="/penjuals/create">Create</a>
                @endcan
                @can('penjual-delete')
                <a class="btn btn-info" href="penjuals/trash">Trash</a>
                @endcan
            </div>
            <div class="my-3 col-12 col-sm-8 col-md-5">
                <form action="/penjuals/search" method="post">
                    @csrf
                    <div class="input-group mb-3">
                        <input type="text" class="form-control" placeholder="Keyword" name = "keyword" aria-label="Keyword" aria-describedby="basic-addon1">
                        <button type="submit" class="input-group-text btn btn-primary" id="basic-addon1">Search</button>
                    </div>
                </form>
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
            <th>ID penjual</th>
            <th>Nama Penjual</th>
            <th>No Telp</th>
            <th>Alamat Penjual</th>
            <th width="280px">Action</th>
        </tr>
        @foreach ($penjuals as $penjual)
        <tr>
            <td>{{ $penjual->id_penjual }}</td>
            <td>{{ $penjual->nama_penjual }}</td>
            <td>{{ $penjual->no_telp }}</td>
            <td>{{ $penjual->alamat_penjual }}</td>
            <td>
            <div class="d-flex gap-3">
                    <form class="m-0" action="/penjuals/edit/{{$penjual->id_penjual}}" method="POST">
                    <a class="btn btn-info" href="/penjuals/show/{{$penjual->id_penjual}}">Show</a>
                    @can('penjual-edit')
                    <a class="btn btn-primary" href="/penjuals/edit/{{$penjual->id_penjual}}">Edit</a>
                    @endcan
                                        <!-- Button trigger modal -->
                    <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#hapusModal">
                        Delete
                    </button>
                    </form>
                </div>
                <div class="modal fade" id="hapusModal" tabindex="-1" aria-labelledby="hapusModalLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="hapusModalLabel">Confirmation</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                Are you sure you want to delete this data?
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                                <form action="/penjuals/delete/{{$penjual->id_penjual}}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    @can('penjual-delete')
                                    <button class="btn btn-danger" type="submit">Move to Trash</button>
                                    @endcan 
                                </form>
                                
                            </div>
                        </div>
                    </div>
                </div>

                <!-- <form action="/penjuals/delete/{{$penjual->id_penjual}}" method="POST">
                    <a class="btn btn-info" href="/penjuals/show/{{$penjual->id_penjual}}">Show</a>
                    @can('penjual-edit')
                    <a class="btn btn-primary" href="/penjuals/edit/{{$penjual->id_penjual}}">Edit</a>
                    @endcan
                    @csrf
                    @method('DELETE')
                    @can('penjual-delete')
                    <button type="submit" class="btn btn-danger">Delete</button>
                    @endcan
                </form> -->
            </td>
        </tr>
        @endforeach
    </table>
    
@endsection

