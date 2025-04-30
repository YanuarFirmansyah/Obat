@extends('layouts.main')
<title>WDObat | Periksa</title>
@section('content-header')
<div class="container-fluid">
    <div class="row mb-2">
      <div class="col-sm-6">
        <h1>Periksa</h1>
      </div>
      <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
          <li class="breadcrumb-item"><a href="/dashboard">Home</a></li>
          <li class="breadcrumb-item active">Periksa</li>
        </ol>
      </div>
    </div>
  </div><!-- /.container-fluid -->
@endsection

@section('content')
<div class="container-fluid">
    <div class="row">
      <div class="col-12">
        <!-- general form elements -->
        <div class="card card-primary">
            <div class="card-header">
                <h3 class="card-title">Form Periksa</h3>
            </div><!-- /.card-header -->
            <!-- form start -->
            <form action="{{ route('pasien.store') }}" method="POST">
                  @csrf
                  <div class="card-body">
                      <div class="form-group">
                          <label>Dokter</label>
                          <select class="custom-select" name="id_dokter">
                              <option value="">Pilih Dokter</option>
                              @foreach ($dokters as $dokter)
                                  <option value="{{ $dokter->id }}">{{ $dokter->nama }}</option>
                              @endforeach
                          </select>
                      </div>
                  </div>
                  <div class="card-footer text-right">
                      <button type="submit" class="btn btn-primary">
                          <i class="fas fa-save"></i>&nbsp; Simpan
                      </button>
                  </div>
              </form>
          </div><!-- /.card -->
        </div>
        <div class="col-12">
            <div class="card card-primary">
                <div class="card-header">
                    <h3 class="card-title">Riwayat Periksa</h3>
                    <div class="card-tools">
                        <div class="input-group input-group-sm" style="width: 150px;">
                            <input type="text" name="table_search" class="form-control float-right"
                                placeholder="Search">
                            <div class="input-group-append">
                                <button type="submit" class="btn btn-default">
                                    <i class="fas fa-search"></i>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- /.card-header -->
                 <div class="card-body table-responsive p-0 fixed-table">
                    <table class="table text-nowrap">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Dokter</th>
                                <th>Tanggal</th>
                                <th>Biaya Periksa</th>
                                <th>Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($riwayat as $i => $r)
                            <tr>
                                <td>{{ $i + 1 }}</td>
                                <td>{{ $r->dokter->nama }}</td>
                                <td>{{ $r->tgl_periksa ? \Carbon\Carbon::parse($r->tgl_periksa)->translatedFormat('l, d F Y') : 'N/A' }}</td>
                                <td>{{ $r->biaya_periksa ? 'Rp ' . number_format($r->biaya_periksa, 0, ',', '.') : 'N/A' }}</td>
                                <td>
                                    @if ($r->status === 'Sudah Diperiksa')
                                        <span class="badge bg-success">{{ $r->status }}</span>
                                    @else
                                        <span class="badge bg-warning">{{ $r->status }}</span>
                                    @endif
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                <!-- /.card-body -->
              </div>
              <!-- /.card -->
          </div>
          @endsection
        </div>
    </div>
</div>