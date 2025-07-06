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
        $polis = \App\Models\Poli::all();
        $dokters = User::where('role', 'dokter')->get();
        $riwayat = Periksa::with('dokter')->where('id_pasien', auth()->id())->get();
        $user = auth()->user();
        // Ambil semua jadwal periksa, group by id_dokter
        $jadwalPerDokter = [];
        foreach ($dokters as $dokter) {
            $jadwalPerDokter[$dokter->id] = $dokter->jadwalPeriksas()->get()->map(function($j) {
                // Pastikan $j adalah object, bukan array
                return [
                    'id' => is_object($j) ? $j->id : (is_array($j) && isset($j['id']) ? $j['id'] : null),
                    'hari' => is_object($j) ? $j->hari : (is_array($j) && isset($j['hari']) ? $j['hari'] : null),
                    'jam_mulai' => is_object($j) ? $j->jam_mulai : (is_array($j) && isset($j['jam_mulai']) ? $j['jam_mulai'] : null),
                    'jam_selesai' => is_object($j) ? $j->jam_selesai : (is_array($j) && isset($j['jam_selesai']) ? $j['jam_selesai'] : null),
                ];
            })->toArray();
        }
        return view('periksa-page', compact('dokters', 'riwayat', 'polis', 'user', 'jadwalPerDokter')); // kirim ke view
    }

    public function storePeriksa(Request $request)
    {
        $request->validate([
            'id_dokter' => 'required|exists:users,id',
            'keluhan' => 'required|string',
        ]);

        Periksa::create([
            'id_pasien' => Auth::id(),
            'id_dokter' => $request->id_dokter,
            'tgl_periksa' => now(),
            'keluhan' => $request->keluhan,
            'catatan' => '',
            'biaya_periksa' => 0,
            'status' => 'Belum Diperiksa',
        ]);

        return redirect()->route('pasien.periksa.form')->with('success', 'Berhasil mendaftar periksa.');
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
            'obat_ids' => 'nullable',
        ]);

        // Ambil array id obat, support jika value string dipisah koma
        $obatIds = $request->input('obat_ids');
        if (is_array($obatIds)) {
            $obatIds = array_filter($obatIds);
        } elseif (is_string($obatIds)) {
            $obatIds = array_filter(explode(',', $obatIds));
        } else {
            $obatIds = [];
        }

        try {
            \DB::beginTransaction();

            $biayaObat = Obat::whereIn('id', $obatIds)->sum('harga');
            $biaya = 150000 + $biayaObat;

            $periksa = Periksa::with('periksaObats.obat')->findOrFail($id);
            $periksa->update([
                'tgl_periksa' => $request->tanggal,
                'catatan' => $request->catatan,
                'biaya_periksa' => $biaya,
                'status' => 'Sudah Diperiksa',
            ]);

            $periksa->obats()->detach();
            foreach ($obatIds as $idObat) {
                if ($idObat) {
                    $periksa->obats()->attach($idObat);
                }
            }

            \DB::commit();
        } catch (\Throwable $e) {
            \DB::rollBack();
            return back()->withInput()->withErrors(['msg' => 'Gagal menyimpan data: ' . $e->getMessage()]);
        }

        // Setelah periksa, kembali ke daftar periksa pasien (memeriksa) dan tampilkan pesan sukses
        return redirect()->route('memeriksa.index')->with('success', 'Pemeriksaan berhasil disimpan.');
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
            'obat_ids' => 'nullable',
        ]);

        // Ambil array id obat, support jika value string dipisah koma
        $obatIds = $request->input('obat_ids');
        if (is_array($obatIds)) {
            $obatIds = array_filter($obatIds);
        } elseif (is_string($obatIds)) {
            $obatIds = array_filter(explode(',', $obatIds));
        } else {
            $obatIds = [];
        }

        try {
            \DB::beginTransaction();

            $biayaObat = Obat::whereIn('id', $obatIds)->sum('harga');
            $biaya = 150000 + $biayaObat;

            $periksa = Periksa::findOrFail($id);
            $periksa->update([
                'tgl_periksa' => $request->tanggal,
                'catatan' => $request->catatan,
                'biaya_periksa' => $biaya,
            ]);

            $periksa->obats()->detach();
            foreach ($obatIds as $idObat) {
                if ($idObat) {
                    $periksa->obats()->attach($idObat);
                }
            }

            \DB::commit();
        } catch (\Throwable $e) {
            \DB::rollBack();
            return back()->withInput()->withErrors(['msg' => 'Gagal menyimpan data: ' . $e->getMessage()]);
        }

        // Setelah simpan perubahan, reload ke daftar periksa pasien (memeriksa)
        return redirect()->route('memeriksa.index')->with('success', 'Pemeriksaan berhasil diperbarui.');
    }

    // Tampilkan form tambah dokter (untuk admin)
    public function create()
    {
        $polis = \App\Models\Poli::all();
        return view('dokter.create', compact('polis'));
    }

    // Tampilkan daftar semua dokter (untuk admin)
    public function index()
    {
        $dokters = \App\Models\User::where('role', 'dokter')->get();
        return view('dokter.index', compact('dokters'));
    }

    // Tampilkan form edit dokter (untuk admin)
    public function edit($id)
    {
        $dokter = \App\Models\User::where('role', 'dokter')->findOrFail($id);
        $polis = \App\Models\Poli::all();
        return view('dokter.edit', compact('dokter', 'polis'));
    }

    // Update dokter (untuk admin)
    public function update(Request $request, $id)
    {
        $request->validate([
            'nama' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'password' => 'nullable|string|min:8|confirmed',
            'id_poli' => 'required|exists:polis,id',
        ]);

        $dokter = User::findOrFail($id);
        $dokter->nama = $request->nama;
        $dokter->email = $request->email;
        if ($request->filled('password')) {
            $dokter->password = bcrypt($request->password);
        }
        $dokter->id_poli = $request->id_poli;
        $dokter->save();

        return redirect()->route('dokter.index')->with('success', 'Dokter berhasil diperbarui.');
    }

    // Simpan dokter baru (untuk admin)
    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required|string|max:255',
            'alamat' => 'required|string|max:255',
            'no_hp' => 'required|string|max:15',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|string|min:8',
            'id_poli' => 'required|exists:polis,id',
        ]);

        \App\Models\User::create([
            'nama' => $request->nama,
            'alamat' => $request->alamat,
            'no_hp' => $request->no_hp,
            'email' => $request->email,
            'password' => bcrypt($request->password),
            'role' => 'dokter',
            'id_poli' => $request->id_poli,
        ]);

        return redirect()->route('dokter.index')->with('success', 'Dokter berhasil ditambahkan!');
    }

    // Halaman profil dokter
    public function profil()
    {
        $user = Auth::user();
        return view('dokter.profil', compact('user'));
    }

    // Update profil dokter
    public function updateProfil(Request $request)
    {
        $request->validate([
            'nama' => 'required|string|max:255',
            'alamat' => 'required|string|max:255',
            'no_hp' => 'required|string|max:20',
        ]);
        $user = Auth::user();
        $user->nama = $request->nama;
        $user->alamat = $request->alamat;
        $user->no_hp = $request->no_hp;
        $user->save();
        return redirect()->route('dokter.profil')->with('success', 'Profil berhasil diperbarui.');
    }

    public function destroy($id)
    {
        $dokter = \App\Models\User::where('role', 'dokter')->findOrFail($id);
        $dokter->delete();
        return redirect()->route('dokter.index')->with('success', 'Data dokter berhasil dihapus.');
    }
}