@extends('layouts.main')

@section('content')
<div class="container">
    <h1>Edit Poli</h1>
    <form action="{{ route('poli.update', $poli->id) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="mb-3">
            <label>Nama Poli</label>
            <input type="text" name="nama_poli" class="form-control" value="{{ old('nama_poli', $poli->nama_poli) }}" required>
        </div>
        <div class="mb-3">
            <label>Keterangan</label>
            <textarea name="keterangan" class="form-control">{{ old('keterangan', $poli->keterangan) }}</textarea>
        </div>
        <button type="submit" class="btn btn-primary">Update</button>
        <a href="{{ route('poli.index') }}" class="btn btn-secondary">Batal</a>
    </form>
</div>
@endsection
