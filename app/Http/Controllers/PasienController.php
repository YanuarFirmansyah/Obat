<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class PasienController extends Controller
{
    // Tampilkan daftar pasien
    public function index()
    {
        $pasiens = User::where('role', 'pasien')->get();
        return view('pasien.index', compact('pasiens'));
    }

    // Tampilkan form tambah pasien
    public function create()
    {
        return view('pasien.create');
    }

    // Simpan pasien baru
    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required|string|max:255',
            'alamat' => 'required|string|max:255',
            'no_ktp' => 'required|string|max:30|unique:users,no_ktp',
            'no_hp' => 'required|string|max:15',
            'email' => 'required|email|unique:users,email',
        ]);

        // Hitung jumlah pasien yang sudah terdaftar di bulan dan tahun ini
        $now = now();
        $tahunBulan = $now->format('Ym');
        $count = User::where('role', 'pasien')
            ->whereYear('created_at', $now->year)
            ->whereMonth('created_at', $now->month)
            ->count();
        $no_rm = $tahunBulan . '-' . ($count + 1);

        User::create([
            'nama' => $request->nama,
            'alamat' => $request->alamat,
            'no_ktp' => $request->no_ktp,
            'no_hp' => $request->no_hp,
            'no_rm' => $no_rm,
            'email' => $request->email,
            'role' => 'pasien',
            // Anda bisa menambahkan password default jika perlu
            'password' => bcrypt('password123'),
        ]);

        return redirect()->route('pasien.index')->with('success', 'Pasien berhasil ditambahkan! No RM: ' . $no_rm);
    }

    // Tampilkan form edit pasien
    public function edit($id)
    {
        $pasien = User::where('role', 'pasien')->findOrFail($id);
        return view('pasien.edit', compact('pasien'));
    }

    // Update data pasien
    public function update(Request $request, $id)
    {
        $pasien = User::where('role', 'pasien')->findOrFail($id);
        $request->validate([
            'nama' => 'required|string|max:255',
            'alamat' => 'required|string|max:255',
            'no_hp' => 'required|string|max:15',
            'email' => 'required|email|unique:users,email,' . $id,
        ]);

        $pasien->update([
            'nama' => $request->nama,
            'alamat' => $request->alamat,
            'no_hp' => $request->no_hp,
            'email' => $request->email,
        ]);

        return redirect()->route('pasien.index')->with('success', 'Data pasien berhasil diperbarui!');
    }

    // Hapus pasien
    public function destroy($id)
    {
        $pasien = User::where('role', 'pasien')->findOrFail($id);
        $pasien->delete();
        return redirect()->route('pasien.index')->with('success', 'Data pasien berhasil dihapus!');
    }
}
