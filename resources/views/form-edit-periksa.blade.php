
@extends('layouts.main')
<title>WDObat | Edit Pemeriksaan</title>
@section('content-header')
<div class="container-fluid">
    <div class="row mb-2">
      <div class="col-sm-6">
        <h1 class="m-0">Edit Pemeriksaan Pasien</h1>
      </div>
      <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
          <li class="breadcrumb-item"><a href="/dashboard">Home</a></li>
          <li class="breadcrumb-item"><a href="{{ route('dokter.index') }}" class="{{ request()->is('memeriksa') }}">Memeriksa</a></li>
          <li class="breadcrumb-item active">Edit Pemeriksaan</li>
        </ol>
      </div>
    </div>
</div>
@endsection

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="card card-primary">
                <div class="card-header">
                    <h3 class="card-title">Form Edit Pemeriksaan</h3>
                </div>
                <form action="{{ route('dokter.periksa.update', $periksa->id) }}" method="POST">
                    @csrf
                    @method('PUT') <!-- method override supaya update -->

                    <div class="card-body">
                        <div class="form-group">
                            <label>Nama Pasien</label>
                            <input type="text" class="form-control" value="{{ $periksa->pasien->nama }}" readonly>
                        </div>

                        <div class="form-group">
                            <label>Tanggal Pemeriksaan</label>
                            <input type="date" name="tanggal" class="form-control" value="{{ old('tanggal', $periksa->tgl_periksa ? date('Y-m-d', strtotime($periksa->tgl_periksa)) : '') }}" required>
                        </div>

                        <div class="form-group">
                            <label>Catatan</label>
                            <textarea name="catatan" class="form-control" rows="3">{{ old('catatan', $periksa->catatan) }}</textarea>
                        </div>

                        <div class="form-group">
                            <label>Obat</label>
                            <div class="d-flex">
                                <select class="custom-select form-control" id="obat-select">
                                    <option value="">Pilih Obat</option>
                                    @foreach ($obats as $obat)
                                        <option value="{{ $obat->id }}" data-nama="{{ $obat->nama_obat }} - {{ $obat->kemasan }}" data-harga="{{ $obat->harga }}">
                                            {{ $obat->nama_obat }} - {{ $obat->kemasan }} - Rp {{ number_format($obat->harga, 0, ',', '.') }}
                                        </option>
                                    @endforeach
                                </select>
                                <button type="button" id="clear-all-obats" class="btn btn-outline-danger ml-2" style="display: none;">
                                    <i class="fas fa-trash-alt"></i>
                                </button>
                            </div>

                            <div class="selected-obats mt-3" id="selected-obats-container" style="{{ $periksa->obats->isEmpty() ? 'display: none;' : '' }}">
                                <ul class="list-group" id="selected-obats-list">
                                    @foreach($periksa->obats as $obat)
                                    <li class="list-group-item d-flex justify-content-between align-items-center" 
                                        data-nama="{{ $obat->nama_obat }}" 
                                        data-kemasan="{{ $obat->kemasan }}"
                                        data-harga="{{ $obat->harga }}">
                                        {{ $obat->nama_obat }} - {{ $obat->kemasan }} - Rp {{ number_format($obat->harga, 0, ',', '.') }}
                                        <button type="button" class="btn btn-sm text-danger ml-2" data-id="{{ $obat->id }}">
                                            <i class="fas fa-times"></i>
                                        </button>
                                    </li>
                                    @endforeach
                                </ul>
                            </div>

                            <div id="obat-ids-container">
                                @foreach($periksa->obats as $obat)
                                    <input type="hidden" name="obat_ids[]" value="{{ $obat->id }}">
                                @endforeach
                            </div>
                        </div>

                        <div class="form-group">
                            <label>Total Biaya</label>
                            <input type="text" id="biaya_periksa_display" class="form-control mb-2" value="Rp{{ number_format(150000 + $periksa->obats->sum('harga')) }}" readonly>
                            <input type="hidden" id="biaya_periksa_value" name="total_biaya" value="{{ 150000 + $periksa->obats->sum('harga') }}">
                        </div>

                        <small class="text-muted">* Biaya periksa Rp150.000 + total harga obat</small>
                    </div>

                    <div class="card-footer text-right">
                        <button type="submit" class="btn btn-primary"><i class="fas fa-save"></i>&nbsp; Simpan Perubahan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
