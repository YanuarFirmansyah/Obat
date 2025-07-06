@extends('layouts.main')

@section('content')
<div class="container">
    <h1>Edit Dokter</h1>
    <form action="{{ route('dokter.update', $dokter->id) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="mb-3">
            <label>Nama</label>
            <input type="text" name="nama" class="form-control" value="{{ old('nama', $dokter->nama) }}" required>
        </div>
        <div class="mb-3">
            <label>Alamat</label>
            <input type="text" name="alamat" class="form-control" value="{{ old('alamat', $dokter->alamat) }}" required>
        </div>
        <div class="mb-3">
            <label>No HP</label>
            <input type="text" name="no_hp" class="form-control" value="{{ old('no_hp', $dokter->no_hp) }}" required>
        </div>
        <div class="mb-3">
            <label>Email</label>
            <input type="email" name="email" class="form-control" value="{{ old('email', $dokter->email) }}" required>
        </div>
        <div class="mb-3">
            <label>Poli</label>
            <select name="id_poli" class="form-control" required>
                <option value="">-- Pilih Poli --</option>
                @foreach($polis as $poli)
                    <option value="{{ $poli->id }}" {{ (old('id_poli', $dokter->id_poli) == $poli->id) ? 'selected' : '' }}>{{ $poli->nama_poli }}</option>
                @endforeach
            </select>
        </div>
        <button type="submit" class="btn btn-primary">Update</button>
        <a href="{{ route('dokter.index') }}" class="btn btn-secondary">Batal</a>
    </form>
</div>
@endsection
