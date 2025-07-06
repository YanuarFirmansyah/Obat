<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class DokterCrudController extends Controller
{
    // Tampilkan daftar dokter
    public function index()
    {
        $dokters = User::where('role', 'dokter')->get();
        return view('dokter.index', compact('dokters'));
    }

    // Tampilkan form tambah dokter
    public function create()
    {
        return view('dokter.create');
    }

    // Simpan dokter baru
    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required|string|max:255',
            'alamat' => 'required|string|max:255',
            'no_hp' => 'required|string|max:15',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|string|min:8',
        ]);

        User::create([
            'nama' => $request->nama,
            'alamat' => $request->alamat,
            'no_hp' => $request->no_hp,
            'email' => $request->email,
            'password' => bcrypt($request->password),
            'role' => 'dokter',
        ]);

        return redirect()->route('dokter.index')->with('success', 'Dokter berhasil ditambahkan!');
    }

    // Tampilkan form edit dokter
    public function edit($id)
    {
        $dokter = User::where('role', 'dokter')->findOrFail($id);
        return view('dokter.edit', compact('dokter'));
    }

    // Update data dokter
    public function update(Request $request, $id)
    {
        $dokter = User::where('role', 'dokter')->findOrFail($id);
        $request->validate([
            'nama' => 'required|string|max:255',
            'alamat' => 'required|string|max:255',
            'no_hp' => 'required|string|max:15',
            'email' => 'required|email|unique:users,email,' . $id,
        ]);

        $dokter->update([
            'nama' => $request->nama,
            'alamat' => $request->alamat,
            'no_hp' => $request->no_hp,
            'email' => $request->email,
        ]);

        return redirect()->route('dokter.index')->with('success', 'Data dokter berhasil diperbarui!');
    }

    // Hapus dokter
    public function destroy($id)
    {
        $dokter = User::where('role', 'dokter')->findOrFail($id);
        $dokter->delete();
        return redirect()->route('dokter.index')->with('success', 'Data dokter berhasil dihapus!');
    }
}
