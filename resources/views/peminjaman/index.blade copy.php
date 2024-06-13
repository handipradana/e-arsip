@extends('layouts.app')

@section('title', 'Peminjaman Index')

@section('content')
<div class="container">
    <div class="row mb-3">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h2>Data Peminjaman</h2>
            </div>
            @if(Auth::user()->role === 'operator')
            <div class="pull-right">
                <a class="btn btn-primary" href="{{ route('home') }}"> Home</a>
            </div>
            @endif
        </div>
    </div>

    @if ($message = Session::get('success'))
        <div class="alert alert-success">
            <p>{{ $message }}</p>
        </div>
    @endif

    <table class="table table-bordered" id="peminjaman-table">
        <thead>
            <tr>
                <th>No</th>
                <th>User</th>
                <th>Barang</th>
                <th>Jumlah</th>
                <th>Status</th>
                <th width="280px">Action</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($peminjaman as $p)
            <tr>
                <td>{{ $loop->iteration }}</td>
                <td>{{ $p->user->name }}</td>
                <td>{{ $p->barang->name }}</td>
                <td>{{ $p->jumlah }}</td>
                <td>{{ $p->status }}</td>
                <td>
                    @if(Auth::user()->role === 'operator')
                    <form action="{{ route('peminjaman.update', $p->id) }}" method="POST">
                        @csrf
                        @method('PUT')

                        <select name="status" class="form-control">
                            <option value="pending" {{ $p->status == 'pending' ? 'selected' : '' }}>Pending</option>
                            <option value="approved" {{ $p->status == 'approved' ? 'selected' : '' }}>Approved</option>
                            <option value="rejected" {{ $p->status == 'rejected' ? 'selected' : '' }}>Rejected</option>
                        </select>

                        <button type="submit" class="btn btn-primary mt-2">Update</button>
                    </form>
                    @else
                    <a class="btn btn-info" href="{{ route('peminjaman.show', $p->id) }}">Show</a>
                    @endif
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection

@push('scripts')
<script>
    $(document).ready(function() {
        $('#peminjaman-table').DataTable();
    });
</script>
@endpush
