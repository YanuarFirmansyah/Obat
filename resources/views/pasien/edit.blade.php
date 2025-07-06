@extends('layouts.main')

@section('content')
<div class="container">
    <h1>Edit Pasien</h1>
    <form action="{{ route('pasien.update', $pasien->id) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="mb-3">
            <label>Nama</label>
            <input type="text" name="nama" class="form-control" value="{{ old('nama', $pasien->nama) }}" required>
        </div>
        <div class="mb-3">
            <label>Alamat</label>
            <input type="text" name="alamat" class="form-control" value="{{ old('alamat', $pasien->alamat) }}" required>
        </div>
        <div class="mb-3">
            <label>No KTP</label>
            <input type="text" name="no_ktp" class="form-control" value="{{ old('no_ktp', $pasien->no_ktp) }}" required readonly>
        </div>
        <div class="mb-3">
            <label>No HP</label>
            <input type="text" name="no_hp" class="form-control" value="{{ old('no_hp', $pasien->no_hp) }}" required>
        </div>
        <button type="submit" class="btn btn-primary">Update</button>
        <a href="{{ route('pasien.index') }}" class="btn btn-secondary">Batal</a>
    </form>
</div>
@endsection
