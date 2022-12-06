@extends('layouts.app')
@section('content')
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h2>Database Vinyl</h2>
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
            <th>Nama Pembeli</th>
            <th>Nama Penjual</th>
            <th>Title</th>
            <th>Artist</th>
            <th>Stats</th>
        </tr>
        
        @foreach ($joins as $join)
        <tr>
            <td>{{ $join->nama_pembeli }}</td>
            <td>{{ $join->nama_penjual }}</td>
            <td>{{ $join->title }} </td>
            <td>{{ $join->artist }} </td>
            <td>{{ $join->stats }} </td>
        </tr>
        @endforeach
    </table>
    {!! $joins->links() !!}
@endsection