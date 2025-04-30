@extends('layouts.main')
<title>WDObat | Memeriksa Pasien</title>
@section('content-header')
<div class="container-fluid">
    <div class="row mb-2">
      <div class="col-sm-6">
        <h1 class="m-0">Memeriksa Pasien</h1>
      </div>
      <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
          <li class="breadcrumb-item"><a href="/dashboard">Home</a></li>
          <li class="breadcrumb-item"><a href="{{ route('dokter.index') }}" class="{{ request()->is('memeriksa') }}">Memeriksa</a></li>
          <li class="breadcrumb-item active">Memeriksa Pasien</li>
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
                    <h3 class="card-title">Form Memeriksa Pasien</h3>
                </div>
                <form action="{{ route('dokter.periksa.simpan', $periksa->id) }}" method="POST">
                    @csrf
                    <div class="card-body">
                        <div class="form-group">
                            <label>Nama Pasien</label>
                            <input type="text" class="form-control" value="{{ $periksa->pasien->nama }}" readonly>
                        </div>
                    
                        <div class="form-group">
                            <label>Tanggal Pemeriksaan</label>
                            <input type="date" class="form-control" name="tanggal" required>
                        </div>
                    
                        <div class="form-group">
                            <label>Catatan</label>
                            <textarea name="catatan" class="form-control" placeholder="Masukkan Catatan Pemeriksaan" ></textarea>
                        </div>

                        <!-- <div class="form-group">
                            <label>Obat</label>
                            <select name="id_obat" class="form-control" required>
                                <option value="">Pilih Obat</option>
                                @foreach($obats as $obat)
                                <option value="{{ $obat->id }}" data-harga="{{ $obat->harga }}">
                                    {{ $obat->nama_obat }} - {{ $obat->kemasan }} - Rp{{ number_format($obat->harga) }}
                                </option>
                                @endforeach
                            </select>
                        </div> -->

                        <div class="form-group">
                            <label>Obat</label>
                            <div class="d-flex">
                            <select class="custom-select form-control" id="obat-select">
                                <option value="">Pilih Obat</option>
                                @foreach($obats as $obat)
                                    <option value="{{ $obat->id }}" data-nama="{{ $obat->nama_obat }} - {{ $obat->kemasan }}" data-harga="{{ $obat->harga }}">
                                        {{ $obat->nama_obat }} - {{ $obat->kemasan }} - {{ $obat->harga }}
                                    </option>
                                @endforeach
                            </select>
                                <button type="button" id="clear-all-obats" class="btn btn-outline-danger ml-2" style="display: none;">
                                    <i class="fas fa-trash-alt"></i>
                                </button>
                            </div>

                            <div class="selected-obats mt-3" id="selected-obats-container">
                                <ul class="list-group" id="selected-obats-list"></ul>
                            </div>

                            <div id="obat-ids-container"></div>
                        </div>

                        <div class="form-group">
                            <label>Total Biaya</label>
                            <input type="text" id="biaya_periksa_display" class="form-control" readonly>
                            <input type="hidden" name="biaya_periksa" id="biaya_periksa_value">
                        </div>
                    
                        <!-- <div class="form-group">
                            <label>Total Biaya</label>
                            <input type="text" id="total" class="form-control" name="biaya" value="150000" readonly>
                        </div> -->
                        <small class="text-muted">* Biaya periksa Rp150.000 + total harga obat</small>
                    </div>

                    <div class="card-footer text-right">
                        <button type="submit" class="btn btn-primary"><i class="fas fa-save"></i>&nbsp; Simpan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection