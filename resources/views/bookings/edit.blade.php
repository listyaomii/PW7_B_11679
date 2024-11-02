@extends('dashboard')
@section('content')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">

<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0" style="color: #3782BF;"><i class="fa-solid fa-calendar-plus" style="color: #3782BF;"></i> Edit Booking</h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item">
                        <a href="{{ route('bookings.index') }}">Bookings</a>
                    </li>
                    <li class="breadcrumb-item active">Edit</li>
                </ol>
            </div>
        </div>
    </div>
</div>

<div class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-8 offset-md-2">
                <div class="card">
                    <div class="card-header bg-primary text-white">
                        <h5 class="card-title"><i class="fa-solid fa-circle-plus"></i> Form Edit Booking</h5>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('bookings.update', $booking->id) }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')
                            
                            <!-- Row for Kelas and Harga -->
                            <div class="form-row">
                                <div class="form-group col-md-6">
                                    <label for="class">Kelas</label>
                                    <input type="text" name="class" class="form-control @error('class') is-invalid @enderror" id="class" value="{{ old('class', $booking->class) }}" placeholder="Masukkan Kelas">
                                    @error('class')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>

                                <div class="form-group col-md-6">
                                    <label for="price">Harga</label>
                                    <input type="number" name="price" class="form-control @error('price') is-invalid @enderror" id="price" value="{{ old('price', $booking->price) }}" placeholder="Masukkan Harga">
                                    @error('price')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <!-- Dropdown for Buku -->
                            <div class="form-group">
                                <label for="id_book">Pilih Buku</label>
                                <select name="id_book" id="id_book" class="form-control @error('id_book') is-invalid @enderror" required>
                                    <option value="">-- Pilih Buku --</option>
                                    @foreach($books as $book)
                                        <option value="{{ $book->id }}" {{ $book->id == $booking->id_book ? 'selected' : '' }}>
                                            {{ $book->title }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('id_book')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                            <div class="text-right">
                                <button type="submit" class="btn btn-success"><i class="fa-solid fa-floppy-disk"></i> Simpan Perubahan</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
