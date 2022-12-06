@extends('layouts.app')
@section('content')
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h2>Edit Pembeli</h2>
            </div>
            <div class="pull-right">
                <a class="btn btn-primary" href="{{ route('pembelis.index') }}"> Back</a>
            </div>
        </div>
    </div>
    @if ($errors->any())
        <div class="alert alert-danger">
            <strong>Whoops!</strong> There were some problems with your input.<br><br>
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    <form action="/pembelis/edit/{{$pembeli->id_pembeli}}" method="POST">
        @csrf
        <div class="row">
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>ID pembeli:</strong>
                    <input type="number" name="id_pembeli" value="{{ $pembeli->id_pembeli }}" class="form-control" placeholder="id pembeli">
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>Nama pembeli:</strong>
                    <input type="text" name="nama_pembeli" value="{{ $pembeli->nama_pembeli }}" class="form-control" placeholder="Nama pembeli">
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>No Telp:</strong>
                    <input type="number" name="no_telp" value="{{ $pembeli->no_telp }}" class="form-control" placeholder="no_telp">
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>Alamat pembeli:</strong>
                    <input type="text" name="alamat_pembeli" value="{{ $pembeli->alamat_pembeli }}" class="form-control" placeholder="alamat_pembeli">
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12 text-center">
              <button type="submit" class="btn btn-primary">Submit</button>
            </div>
        </div>
    </form>

@endsection

