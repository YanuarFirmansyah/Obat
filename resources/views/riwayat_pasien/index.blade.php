@extends('layouts.main')

@section('content-header')
<div class="container-fluid">
    <div class="row mb-2">
        <div class="col-sm-6">
            <h1>Riwayat Pasien Sudah Diperiksa</h1>
        </div>
        <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="/dashboard">Home</a></li>
                <li class="breadcrumb-item active">Riwayat Pasien</li>
            </ol>
        </div>
    </div>
</div>
@endsection

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="card card-success">
                <div class="card-header">
                    <h3 class="card-title">Riwayat Pasien Sudah Diperiksa</h3>
                </div>
                <div class="card-body table-responsive p-0 fixed-table">
                    <table class="table text-nowrap">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Nama Pasien</th>
                                <th>Alamat</th>
                                <th>No KTP</th>
                                <th>No Telepon</th>
                                <th>No RM</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php $no = 1; @endphp
                            @foreach ($riwayat as $periksa)
                                @php
                                    $dokter = $periksa->dokter ?? null;
                                    $pasien = $periksa->pasien ?? null;
                                    $obats = $periksa->obats ?? [];
                                @endphp
                                <tr>
                                    <td>{{ $no++ }}</td>
                                    <td>{{ $pasien ? $pasien->nama : '-' }}</td>
                                    <td>{{ $pasien ? $pasien->alamat : '-' }}</td>
                                    <td>{{ $pasien ? $pasien->no_ktp : '-' }}</td>
                                    <td>{{ $pasien ? $pasien->no_hp : '-' }}</td>
                                    <td>{{ $pasien ? $pasien->no_rm : '-' }}</td>
                                    <td>
                                        <button type="button" class="btn btn-info btn-sm btn-detail-periksa"
                                            data-toggle="modal"
                                            data-target="#modalDetailPeriksa"
                                            data-id="{{ $periksa->id }}">
                                            Detail Periksa & Riwayat
                                        </button>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Modal -->
<div class="modal fade" id="modalDetailPeriksa" tabindex="-1" role="dialog" aria-labelledby="modalDetailPeriksaLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="modalDetailPeriksaLabel">Detail & Riwayat Pasien</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body" id="modal-detail-content" style="max-height: 60vh; overflow-y: auto;">
        <!-- Konten detail akan diisi via JS -->
      </div>
    </div>
  </div>
</div>
@endsection

@push('styles')
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css">
@endpush

@push('scripts')
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"></script>
<script>
var periksaData = @json($riwayat);

function findPeriksaById(id) {
    return periksaData.find(function(p) { return p.id == id; });
}

$(document).on('click', '.btn-detail-periksa', function() {
    var id = $(this).data('id');
    var periksa = findPeriksaById(id);

    if (!periksa) {
        $('#modal-detail-content').html('<div class="alert alert-danger">Data tidak ditemukan.</div>');
        return;
    }

    let html = '';
    html += '<h5>Detail Periksa</h5>';
    html += '<table class="table table-bordered">';
    html += '<tr><th>No</th><td>' + (periksa.id ?? '-') + '</td></tr>';
    html += '<tr><th>Tanggal Periksa</th><td>' + (periksa.tgl_periksa ?? '-') + '</td></tr>';
    html += '<tr><th>Nama Pasien</th><td>' + (periksa.pasien && periksa.pasien.nama ? periksa.pasien.nama : '-') + '</td></tr>';
    html += '<tr><th>Nama Dokter</th><td>' + (periksa.dokter && periksa.dokter.nama ? periksa.dokter.nama : '-') + '</td></tr>';
    html += '<tr><th>Keluhan</th><td>' + (periksa.keluhan ?? '-') + '</td></tr>';
    html += '<tr><th>Catatan</th><td>' + (periksa.catatan ?? '-') + '</td></tr>';
    html += '<tr><th>Obat</th><td>';

    if (periksa.obats && Array.isArray(periksa.obats) && periksa.obats.length > 0) {
        html += '<div class="table-responsive"><table class="table table-bordered table-striped table-sm mb-0">';
        html += '<thead class="thead-light"><tr><th style="width:40px">No</th><th>Nama Obat</th><th>Kemasan</th></tr></thead><tbody>';
        for (var idx = 0; idx < periksa.obats.length; idx++) {
            var obat = periksa.obats[idx];
            html += '<tr>';
            html += '<td>' + (idx+1) + '</td>';
            html += '<td>' + (obat && obat.nama_obat ? obat.nama_obat : '-') + '</td>';
            html += '<td>' + (obat && obat.kemasan ? obat.kemasan : '-') + '</td>';
            html += '</tr>';
        }
        html += '</tbody></table></div>';
    } else {
        html += '-';
    }

    html += '</td></tr>';
    let biaya = parseInt(periksa.biaya_periksa) || 0;
    html += '<tr><th>Biaya Periksa</th><td>' + (biaya ? 'Rp ' + biaya.toLocaleString('id-ID') : '-') + '</td></tr>';
    html += '</table>';

    $('#modal-detail-content').html(html);
});
</script>
@endpush
