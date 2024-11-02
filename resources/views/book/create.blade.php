@extends('dashboard')
@section('content')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">

<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0" style="color: #3782BF ;"><i class="fa-solid fa-book" style="color: #3782BF ;"></i> Tambah Buku</h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item">
                        <a href="{{ route('book.index') }}">Book</a>
                    </li>
                    <li class="breadcrumb-item active">Create</li>
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
                        <h5 class="card-title"><i class="fa-solid fa-circle-plus"></i> Form Tambah Buku</h5>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('book.store') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            
                            <!-- Row for Upload Gambar and Judul Buku -->
                            <div class="form-row">
                                <div class="form-group col-md-6">
                                    <label for="image">Upload Gambar</label>
                                    <input type="file" name="image" class="form-control" id="image">
                                </div>
                                
                                <div class="form-group col-md-6">
                                    <label for="title">Judul Buku</label>
                                    <input type="text" name="title" class="form-control @error('title') is-invalid @enderror" id="title" placeholder="Masukkan Judul Buku">
                                    @error('title')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <!-- Row for Penulis and Jumlah Halaman -->
                            <div class="form-row">
                                <div class="form-group col-md-6">
                                    <label for="author">Penulis</label>
                                    <input type="text" name="author" class="form-control @error('author') is-invalid @enderror" id="author" placeholder="Masukkan Nama Penulis">
                                    @error('author')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                
                                <div class="form-group col-md-6">
                                    <label for="pages">Jumlah Halaman</label>
                                    <input type="text" name="pages" class="form-control @error('pages') is-invalid @enderror" id="pages" placeholder="Masukkan Jumlah Halaman">
                                    @error('pages')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="text-right">
                                <button type="submit" class="btn btn-success"><i class="fa-solid fa-floppy-disk"></i> Simpan</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
