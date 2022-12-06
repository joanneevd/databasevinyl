@extends('layouts.app')
@section('content')
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h2> Show Penjual</h2>
            </div>
            <div class="pull-right">
                <a class="btn btn-primary" href="{{ route('penjuals.index') }}"> Back</a>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>id penjual:</strong>
                {{ $penjual->id_penjual }}
            </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>Nama Penjual:</strong>
                {{ $penjual->nama_penjual }}
            </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>No Telp:</strong>
                {{ $penjual->no_telp }}
            </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>Alamat Penjual</strong>
                {{ $penjual->alamat_penjual }}
            </div>
        </div>
    </div>
@endsection

