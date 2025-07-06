@extends('layouts.main')
@section('content-header')
<div class="container-fluid">
    <div class="row mb-2">
        <div class="col-sm-6">
            <h1>Tambah Jadwal Periksa</h1>
        </div>
        <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="/dashboard">Home</a></li>
                <li class="breadcrumb-item"><a href="{{ route('jadwal_periksa.index') }}">Jadwal Periksa</a></li>
                <li class="breadcrumb-item active">Tambah</li>
            </ol>
        </div>
    </div>
</div>
@endsection
@section('content')
<div class="container-fluid">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card">
                <div class="card-header"><h3 class="card-title">Form Tambah Jadwal</h3></div>
                <form action="{{ route('jadwal_periksa.store') }}" method="POST">
                    @csrf
                    <div class="card-body">
                        <div class="form-group">
                            <label for="hari">Hari</label>
                            <select name="hari" id="hari" class="form-control" required>
                                <option value="">Pilih Hari</option>
                                <option value="Senin">Senin</option>
                                <option value="Selasa">Selasa</option>
                                <option value="Rabu">Rabu</option>
                                <option value="Kamis">Kamis</option>
                                <option value="Jumat">Jumat</option>
                                <option value="Sabtu">Sabtu</option>
                                <option value="Minggu">Minggu</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="jam_mulai">Jam Mulai</label>
                            <input type="time" name="jam_mulai" id="jam_mulai" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label for="jam_selesai">Jam Selesai</label>
                            <input type="time" name="jam_selesai" id="jam_selesai" class="form-control" required>
                        </div>
                    </div>
                    <div class="card-footer text-right">
                        <a href="{{ route('jadwal_periksa.index') }}" class="btn btn-secondary">Batal</a>
                        <button type="submit" class="btn btn-primary">Simpan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
