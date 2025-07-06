<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\JadwalPeriksa;
use Illuminate\Support\Facades\Auth;

class JadwalPeriksaController extends Controller
{
    // Tampilkan semua jadwal dokter yang login
    public function index()
    {
        $jadwals = JadwalPeriksa::where('id_dokter', Auth::id())->get();
        return view('jadwal_periksa.index', compact('jadwals'));
    }

    // Form tambah jadwal
    public function create()
    {
        return view('jadwal_periksa.create');
    }

    // Simpan jadwal baru
    public function store(Request $request)
    {
        $request->validate([
            'hari' => 'required|string',
            'jam_mulai' => 'required',
            'jam_selesai' => 'required|after:jam_mulai',
        ]);
        JadwalPeriksa::create([
            'id_dokter' => Auth::id(),
            'hari' => $request->hari,
            'jam_mulai' => $request->jam_mulai,
            'jam_selesai' => $request->jam_selesai,
        ]);
        return redirect()->route('jadwal_periksa.index')->with('success', 'Jadwal berhasil ditambahkan!');
    }

    // Form edit jadwal
    public function edit($id)
    {
        $jadwal = JadwalPeriksa::where('id_dokter', Auth::id())->findOrFail($id);
        return view('jadwal_periksa.edit', compact('jadwal'));
    }

    // Update jadwal
    public function update(Request $request, $id)
    {
        $request->validate([
            'hari' => 'required|string',
            'jam_mulai' => 'required',
            'jam_selesai' => 'required|after:jam_mulai',
        ]);
        $jadwal = JadwalPeriksa::where('id_dokter', Auth::id())->findOrFail($id);
        $jadwal->update($request->only(['hari', 'jam_mulai', 'jam_selesai']));
        return redirect()->route('jadwal_periksa.index')->with('success', 'Jadwal berhasil diupdate!');
    }

    // Hapus jadwal
    public function destroy($id)
    {
        $jadwal = JadwalPeriksa::where('id_dokter', Auth::id())->findOrFail($id);
        $jadwal->delete();
        return redirect()->route('jadwal_periksa.index')->with('success', 'Jadwal berhasil dihapus!');
    }
}
