@extends('layouts.admin')

@section('title', 'My Peminjaman')

@section('content')
<div class="container-fluid">
    <div class="row mb-3">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h2>My Peminjaman</h2>
            </div>
            <div class="pull-right">
                <a class="btn btn-primary" href="{{ route('home') }}"> Home</a>
                <a class="btn btn-success" href="{{ route('peminjaman.create') }}"> Create New Peminjaman</a>
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
            <th>No</th>
            <th>Barang</th>
            <th>Jumlah</th>
            <th>Status</th>
            <th width="280px">Action</th>
        </tr>
        @php $i = 0 @endphp
        @foreach ($peminjaman as $p)
        <tr>
            <td>{{ ++$i }}</td>
            <td>{{ $p->barang->name }}</td>
            <td>{{ $p->jumlah }}</td>
            <td>{{ $p->status }}</td>
            <td>
                <a class="btn btn-info" href="{{ route('peminjaman.show', $p->id) }}">Show</a>
            </td>
        </tr>
        @endforeach
    </table>
</div>
@endsection
