@extends('dashboard')
@section('content')
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0">Customer</h1>
            </div>
            <!-- /.col -->
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item">
                        <a href="{{ url('customer')}}">Customer</a>
                    </li>
                    <li class="breadcrumb-item active">Index</li>
                </ol>
            </div>
            <!-- /.col -->
        </div>
        <!-- /.row -->
    </div>
    <!-- /.container-fluid -->
</div>
<!-- /.content-header -->

<!-- Main content -->
<div class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <a href="{{ route('customer.create') }}" class="btn btn-md btn-success mb-3">Tambah Customer</a>
                        <div class="table-responsive p-0">
                            <table class="table table-hover text-no-wrap">
                                <thead>
                                    <tr>
                                        <th class="text-center">Nama Customer</th>
                                        <th class="text-center">Email</th>
                                        <th class="text-center">Nomor Telepon</th>
                                        <th class="text-center">Quantity Booking</th>
                                        <th class="text-center">Class Booking</th>
                                        <th class="text-center">Poster Book</th>
                                        <th class="text-center">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse ($customers as $customer)
                                    <tr>
                                        <td class="text-center">{{ $customer->name }}</td>
                                        <td class="text-center">{{ $customer->email }}</td>
                                        <td class="text-center">{{ $customer->phone }}</td>
                                        <td class="text-center">{{ $customer->quantity }}</td>
                                        <td class="text-center">{{ $customer->booking->class ?? '-' }}</td>
                                        <td class="text-center">
                                        @if ($customer->booking && $customer->booking->book && $customer->booking->book->image)
                                            <img src="{{ asset('storage/' . $customer->booking->book->image) }}" alt="{{ $customer->booking->book->title }}" style="width: 100px; height: auto;">
                                        @else
                                            <img src="{{ asset('storage/' . $customer->booking->book->image) }}" alt="{{ $customer->booking->book->title }}" style="width: 100px; height: auto;">
                                        @endif


                                        </td>
                                        <td class="text-center">
                                            <form onsubmit="return confirm('Apakah Anda Yakin ?');" action="{{ route('customer.destroy', $customer->id) }}" method="POST">
                                                <a href="{{ route('customer.edit', $customer->id) }}" class="btn btn-sm btn-primary">EDIT</a>
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-sm btn-danger">Hapus</button>
                                            </form>
                                        </td>
                                    </tr>
                                    @empty
                                    <div class="alert alert-danger">
                                        Data Customer belum tersedia
                                    </div>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                        {{ $customers->links() }}
                    </div>
                    <!-- /.card-body -->
                </div>
                <!-- /.card -->
            </div>
            <!-- /.col-md-6 -->
        </div>
        <!-- /.row -->
    </div>
    <!-- /.container-fluid -->
</div>
@endsection
