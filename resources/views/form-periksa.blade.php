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
                                <select class="form-control" id="obat-select" name="obat_ids[]" multiple size="6">
                                    @foreach($obats as $obat)
                                        <option value="{{ $obat->id }}" data-harga="{{ $obat->harga }}">
                                            {{ $obat->nama_obat }} - {{ $obat->kemasan }} - {{ $obat->harga }}
                                        </option>
                                    @endforeach
                                </select>
                                <button type="button" id="clear-all-obats" class="btn btn-outline-danger ml-2" onclick="document.getElementById('obat-select').selectedIndex = -1; document.getElementById('obat-select').dispatchEvent(new Event('change'))">
                                    <i class="fas fa-trash-alt"></i>
                                </button>
                            </div>
                            <small class="text-muted">* Gunakan Ctrl (atau Cmd di Mac) untuk memilih lebih dari satu obat</small>
                        </div>
                        <div class="form-group">
                            <label>Total Biaya</label>
                            <input type="text" id="biaya_periksa_display" class="form-control" readonly>
                            <input type="hidden" name="biaya_periksa" id="biaya_periksa_value">
                        </div>
                        <small class="text-muted">* Biaya periksa Rp150.000 + total harga obat</small>
                        <script>
                        document.addEventListener('DOMContentLoaded', function() {
                            const biayaPeriksaDasar = 150000;
                            const obatSelect = document.getElementById('obat-select');
                            const biayaDisplay = document.getElementById('biaya_periksa_display');
                            const biayaValue = document.getElementById('biaya_periksa_value');
                            function updateBiaya() {
                                let totalObat = 0;
                                Array.from(obatSelect.selectedOptions).forEach(opt => {
                                    totalObat += parseInt(opt.getAttribute('data-harga')) || 0;
                                });
                                const total = biayaPeriksaDasar + totalObat;
                                biayaDisplay.value = 'Rp ' + total.toLocaleString('id-ID');
                                biayaValue.value = total;
                            }
                            obatSelect.addEventListener('change', updateBiaya);
                            updateBiaya();
                        });
                        </script>

                    
                    
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