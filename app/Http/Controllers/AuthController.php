<?php

namespace App\Http\Controllers;

use App\Models\Pelanggan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    // Menampilkan form login
    public function showLoginForm()
    {
        return view('auth.login');
    }

    // Menampilkan form register
    public function showRegisterForm()
    {
        return view('auth.register');
    }

    // Proses login
    public function store(Request $request)
    {
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        Log::info('Mencoba login dengan email:', ['email' => $credentials['email']]);

        if (Auth::guard('pelanggan')->attempt($credentials)) {
            $request->session()->regenerate();
            Log::info('Login berhasil untuk user:', ['id' => Auth::guard('pelanggan')->id()]);
            return redirect()->intended('/')->with('success', 'Login berhasil!');
        }

        Log::warning('Login gagal untuk email:', ['email' => $credentials['email']]);
        return back()->withErrors(['email' => 'Login gagal. Periksa kembali email dan password.']);
    }

    // Proses register
    public function register(Request $request)
    {
        $validated = $request->validate([
            'pelanggan' => 'required|string|max:255',
            'alamat' => 'required|string|max:255',
            'telp' => 'required|string|max:15',
            'email' => 'required|string|email|max:255|unique:pelanggans',
            'password' => 'required|string|min:8|confirmed',
        ]);

        try {
            $pelanggan = new Pelanggan();
            $pelanggan->pelanggan = $validated['pelanggan'];
            $pelanggan->alamat = $validated['alamat'];
            $pelanggan->telp = $validated['telp'];
            $pelanggan->email = $validated['email'];
            $pelanggan->password = Hash::make($validated['password']); // Hash password
            $pelanggan->save();

            Log::info('User baru berhasil didaftarkan:', ['email' => $pelanggan->email, 'id' => $pelanggan->idpelanggan]);

            // Langsung login setelah register
            Auth::guard('pelanggan')->login($pelanggan);

            return redirect('/')->with('success', 'Registrasi berhasil! Anda telah login.');
        } catch (\Exception $e) {
            Log::error('Gagal mendaftarkan user:', ['error' => $e->getMessage()]);
            return back()->withErrors(['email' => 'Registrasi gagal. Silakan coba lagi.']);
        }
    }

    // Proses logout
    public function destroy(Request $request)
    {
        $userId = Auth::guard('pelanggan')->id();
        Auth::guard('pelanggan')->logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        Log::info('User logout:', ['id' => $userId]);
        return redirect('/')->with('success', 'Logout berhasil!');
    }
}
