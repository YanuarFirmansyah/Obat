<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use App\Models\Periksa;

class RiwayatPasienController extends Controller
{
    public function index()
    {
        // Hanya tampilkan periksa yang sudah diperiksa oleh dokter yang login
        $riwayat = Periksa::with(['pasien','obats'])
            ->where('id_dokter', Auth::id())
            ->where('status', 'Sudah Diperiksa')
            ->get();
        return view('riwayat_pasien.index', compact('riwayat'));
    }
}
