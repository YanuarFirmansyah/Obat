@extends('layouts.main')
<title>WDObat | Memeriksa</title>
@section('content-header')
<div class="container-fluid">
    <div class="row mb-2">
      <div class="col-sm-6">
        <h1 class="m-0">Memeriksa</h1>
      </div>
      <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
          <li class="breadcrumb-item"><a href="/dashboard">Home</a></li>
          <li class="breadcrumb-item active">Memeriksa</li>
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
                    <h3 class="card-title">Daftar Periksa Pasien</h3>
                    <div class="card-tools">
                        <div class="input-group input-group-sm" style="width: 150px;">
                            <input type="text" name="table_search" class="form-control float-right" placeholder="Search">
                            <div class="input-group-append">
                                <button type="submit" class="btn btn-default">
                                    <i class="fas fa-search"></i>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card-body table-responsive p-0 fixed-table">
                    <table class="table text-nowrap">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Nama Pasien</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($periksas as $index => $periksa)
                            <tr>
                                <td>{{ $index + 1 }}</td>
                                <td>{{ $periksa->pasien->nama }}</td>
                                <td>
                                    @if ($periksa->status === 'Belum Diperiksa')
                                        <a href="{{ route('dokter.periksa.form', $periksa->id) }}" class="btn btn-sm btn-primary"><i class="fas fa-syringe"></i>&nbsp; Periksa</a>
                                    @else
                                        <a href="{{ route('dokter.edit.form', $periksa->id) }}" class="btn btn-sm btn-secondary"><i class="fas fa-pen-nib"></i>&nbsp; Edit</a>
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
    </div>
</div>
@endsection