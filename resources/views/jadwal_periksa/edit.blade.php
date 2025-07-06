@extends('layouts.main')
@section('content-header')
<div class="container-fluid">
    <div class="row mb-2">
        <div class="col-sm-6">
            <h1>Edit Jadwal Periksa</h1>
        </div>
        <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="/dashboard">Home</a></li>
                <li class="breadcrumb-item"><a href="{{ route('jadwal_periksa.index') }}">Jadwal Periksa</a></li>
                <li class="breadcrumb-item active">Edit</li>
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
                <div class="card-header"><h3 class="card-title">Form Edit Jadwal</h3></div>
                <form action="{{ route('jadwal_periksa.update', $jadwal->id) }}" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="card-body">
                        <div class="form-group">
                            <label for="hari">Hari</label>
                            <select name="hari" id="hari" class="form-control" required>
                                <option value="">Pilih Hari</option>
                                @foreach(['Senin','Selasa','Rabu','Kamis','Jumat','Sabtu','Minggu'] as $hari)
                                    <option value="{{ $hari }}" {{ $jadwal->hari == $hari ? 'selected' : '' }}>{{ $hari }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="jam_mulai">Jam Mulai</label>
                            <input type="time" name="jam_mulai" id="jam_mulai" class="form-control" value="{{ $jadwal->jam_mulai }}" required>
                        </div>
                        <div class="form-group">
                            <label for="jam_selesai">Jam Selesai</label>
                            <input type="time" name="jam_selesai" id="jam_selesai" class="form-control" value="{{ $jadwal->jam_selesai }}" required>
                        </div>
                    </div>
                    <div class="card-footer text-right">
                        <a href="{{ route('jadwal_periksa.index') }}" class="btn btn-secondary">Batal</a>
                        <button type="submit" class="btn btn-primary">Update</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
