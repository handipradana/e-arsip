@extends('layouts.admin')

@section('title', 'Barang Index')

@section('content')
<div class="container-fluid">
    <div class="row mb-3">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h2>Data Barang</h2>
            </div>
            <div class="pull-right">
                <a class="btn btn-success" href="{{ route('barangs.create') }}"> Create New Barang</a>
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
            <th>Name</th>
            <th>Deskripsi</th>
            <th>Jumlah</th>
            <th>Gambar</th>
            <th width="280px">Action</th>
        </tr>
        @php $i = 0 @endphp
        @foreach ($barangs as $barang)
        <tr>
            <td>{{ ++$i }}</td>
            <td>{{ $barang->name }}</td>
            <td>{{ $barang->deskripsi }}</td>
            <td>{{ $barang->jumlah }}</td>
            <td><img src="{{ Storage::url($barang->gambar) }}" width="100"></td>
            <td>
                <form action="{{ route('barangs.destroy', $barang->id) }}" method="POST">

                    <a class="btn btn-info" href="{{ route('barangs.show', $barang->id) }}">Show</a>

                    <a class="btn btn-primary" href="{{ route('barangs.edit', $barang->id) }}">Edit</a>

                    @csrf
                    @method('DELETE')

                    <button type="submit" class="btn btn-danger">Delete</button>
                </form>
            </td>
        </tr>
        @endforeach
    </table>
</div>
@endsection
