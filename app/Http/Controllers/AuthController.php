<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{

    public function showLoginForm()
    {
        return view('login');
    }

    public function authenticate(Request $request): RedirectResponse
    {
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();

            // Arahkan berdasarkan role
            $user = Auth::user();
            if (in_array($user->role, ['admin', 'dokter', 'pasien'])) {
                return redirect()->intended('/dashboard');
            }
            // Default fallback
            return redirect()->intended('/');
        }

        return back()->withErrors([
            'email' => 'The provided credentials do not match our records.',
        ])->onlyInput('email');
    }
    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/login');
    }

    public function register(Request $request)
    {
        // Validasi input
        $validator = Validator::make($request->all(), [
            'nama' => ['required', 'string', 'max:255'],
            'alamat' => ['required', 'string', 'max:255'],
            'no_hp' => ['required', 'string', 'max:15'],
            'no_ktp' => ['required', 'string', 'max:20', 'unique:users,no_ktp'],
            'email' => ['required', 'email', 'unique:users,email'],
            'password' => ['required', 'string', 'min:8'],
        ]);
        
        if ($validator->fails()) {
            return redirect()->back()
                        ->withErrors($validator)
                        ->withInput();
        }

        // Generate no_rm sama persis dengan logic admin (tahunBulan-urutan)
        $now = now();
        $tahunBulan = $now->format('Ym');
        $urutan = 1;
        do {
            $no_rm = $tahunBulan . '-' . $urutan;
            $exists = \App\Models\User::where('no_rm', $no_rm)->exists();
            $urutan++;
        } while ($exists);

        // Membuat user baru dengan no_rm yang pasti unik
        $user = User::create([
            'nama' => $request->nama,
            'alamat' => $request->alamat,
            'no_hp' => $request->no_hp,
            'role' => 'pasien',
            'email' => $request->email,
            'password' => bcrypt($request->password),
            'no_ktp' => $request->no_ktp,
            'no_rm' => $no_rm,
        ]);

        // Login pengguna setelah registrasi
        Auth::login($user);

        // Redirect ke halaman dashboard atau halaman lainnya
        return redirect()->route('login');
    }

    public function registerForm()
    {
        return view('register');
    }

}