<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Periksa;
use App\Models\Obat;
use App\Models\PeriksaObat;
use Carbon\Carbon;


class DokterController extends Controller
{
    
    public function indexDokter()
    {   
        $periksas = Periksa::with(['pasien', 'dokter'])
        ->where('id_dokter', Auth::id()) // hanya periksa milik dokter yang login
        ->get();
        return view('memeriksa', compact('periksas'));
    }

    public function indexPasien()
    {
        Carbon::setLocale('id');
        
        $dokters = User::where('role', 'dokter')->get(); // ambil semua user dengan role dokter
        $riwayat = Periksa::with('dokter')->where('id_pasien', auth()->id())->get();
        return view('periksa-page', compact('dokters', 'riwayat')); // kirim ke view
    }

    public function storePeriksa(Request $request)
    {
        $request->validate([
            'id_dokter' => 'required|exists:users,id',
        ]);

        Periksa::create([
            'id_pasien' => Auth::id(),
            'id_dokter' => $request->id_dokter,
            'tgl_periksa' => null,
            'catatan' => '',
            'biaya_periksa' => 0,
        ]);

        return redirect()->route('pasien.index')->with('success', 'Berhasil mendaftar periksa.');
    }

    public function formPeriksa($id)
    {
        $periksa = Periksa::with('pasien')->findOrFail($id);
        $obats = \App\Models\Obat::all();
        return view('form-periksa', compact('periksa', 'obats'));
    }

    public function simpanPeriksa(Request $request, $id)
    {
        $request->validate([
            'tanggal' => 'required|date',
            'catatan' => 'nullable|string',
            'obat_ids' => 'nullable|array',
            'obat_ids.*' => 'exists:obats,id',
        ]);

        $obatIds = $request->input('obat_ids', []);
        $biayaObat = Obat::whereIn('id', $obatIds)->sum('harga');
        $biaya = 150000 + $biayaObat;

        $periksa = Periksa::with('periksaObats.obat')->findOrFail($id);
        $periksa->update([
            'tgl_periksa' => $request->tanggal,
            'catatan' => $request->catatan,
            'biaya_periksa' => $biaya,
            'status' => 'Sudah Diperiksa',
        ]);

        if (!empty($obatIds)) {
            $periksa->obats()->sync($obatIds);
        } else {
            $periksa->obats()->detach();
        }

        return redirect()->route('dokter.index')->with('success', 'Pemeriksaan berhasil disimpan.');
    }

    public function formEditPeriksa($id)
    {
        $periksa = Periksa::with('pasien', 'obats')->findOrFail($id);
        $obats = Obat::all();

        return view('form-edit-periksa', compact('periksa', 'obats'));
    }

    public function updatePeriksa(Request $request, $id)
    {
        $request->validate([
            'tanggal' => 'required|date',
            'catatan' => 'nullable|string',
            'obat_ids' => 'nullable|array',
            'obat_ids.*' => 'exists:obats,id',
        ]);

        $obatIds = $request->input('obat_ids', []);
        
        $biayaObat = Obat::whereIn('id', $obatIds)->sum('harga');
        $biaya = 150000 + $biayaObat;

        $periksa = Periksa::findOrFail($id);
        $periksa->update([
            'tgl_periksa' => $request->tanggal,
            'catatan' => $request->catatan,
            'biaya_periksa' => $biaya,
        ]);

        if (!empty($obatIds)) {
            $periksa->obats()->sync($obatIds);
        } else {
            $periksa->obats()->detach();
        }

        return redirect()->route('dokter.index')->with('success', 'Pemeriksaan berhasil diperbarui.');
    }
}