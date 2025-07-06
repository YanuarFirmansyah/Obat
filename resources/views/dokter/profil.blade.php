@extends('layouts.main')
<title>Profil Dokter</title>
@section('content-header')
<div class="container-fluid">
    <div class="row mb-2">
      <div class="col-sm-6">
        <h1 class="m-0">Profil Dokter</h1>
      </div>
      <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
          <li class="breadcrumb-item"><a href="/dashboard">Home</a></li>
          <li class="breadcrumb-item active">Profil</li>
        </ol>
      </div>
    </div>
</div>
@endsection

@section('content')
<div class="container-fluid">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card card-primary">
                <div class="card-header">
                    <h3 class="card-title">Profil Dokter</h3>
                </div>
                <div class="card-body text-center">
                    <i class="fas fa-user-md fa-4x mb-3 text-primary"></i>
                    <h4 class="mb-1">{{ Auth::user()->nama }}</h4>
                    <p class="mb-1"><i class="fas fa-map-marker-alt mr-1"></i> {{ Auth::user()->alamat ?? '-' }}</p>
                    <p class="mb-1"><i class="fas fa-phone mr-1"></i> {{ Auth::user()->no_hp ?? '-' }}</p>
                    <p class="mb-1"><i class="fas fa-envelope mr-1"></i> {{ Auth::user()->email }}</p>
                    <hr>
                    <form action="{{ route('dokter.profil.update') }}" method="POST" class="text-left">
                        @csrf
                        @method('PUT')
                        <div class="form-group">
                            <label>Nama</label>
                            <input type="text" name="nama" class="form-control" value="{{ old('nama', Auth::user()->nama) }}" required>
                        </div>
                        <div class="form-group">
                            <label>Alamat</label>
                            <input type="text" name="alamat" class="form-control" value="{{ old('alamat', Auth::user()->alamat) }}" required>
                        </div>
                        <div class="form-group">
                            <label>No. Telepon</label>
                            <input type="text" name="no_hp" class="form-control" value="{{ old('no_hp', Auth::user()->no_hp) }}" required>
                        </div>
                        <div class="card-footer text-right bg-white border-0">
                            <button type="submit" class="btn btn-primary"><i class="fas fa-save"></i> Simpan</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
