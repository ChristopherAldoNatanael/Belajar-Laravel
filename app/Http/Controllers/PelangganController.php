<?php

namespace App\Http\Controllers;

use App\Models\Pelanggan;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log as log;

class PelangganController extends Controller
{
    // Method to show profile page
    public function showProfile()
    {
        $pelanggan = Auth::guard('pelanggan')->user();
        return view('pelanggan.profile', compact('pelanggan'));
    }

    // Method to update profile
   // Method to update profile
public function updateProfile(Request $request)
{
    $pelanggan = Auth::guard('pelanggan')->user();

    $validated = $request->validate([
        'pelanggan' => 'required|string|max:255',
        'email' => [
            'required',
            'email',
            Rule::unique('pelanggans')->ignore($pelanggan->idpelanggan, 'idpelanggan'),
        ],
        'alamat' => 'required|string|max:255',
        'telp' => 'required|string|max:255',
    ]);

    try {
        // Use update method instead of save
        $result = Pelanggan::where('idpelanggan', $pelanggan->idpelanggan)
            ->update([
                'pelanggan' => $validated['pelanggan'],
                'email' => $validated['email'],
                'alamat' => $validated['alamat'],
                'telp' => $validated['telp'],
                'updated_at' => now(),
            ]);

        if ($result) {
            return redirect()->route('pelanggan.profile')->with('success', 'Profil berhasil diperbarui!');
        } else {
            return back()->withErrors(['general' => 'Failed to update profile. Please try again.']);
        }
    } catch (\Exception $e) {
        return back()->withErrors(['general' => 'An error occurred: ' . $e->getMessage()]);
    }
}

    // Method to show password change form
    public function showChangePasswordForm()
    {
        return view('pelanggan.change-password');
    }

    // Method to update password
    public function updatePassword(Request $request)
    {
        $request->validate([
            'current_password' => 'required',
            'password' => 'required|string|min:8|confirmed',
        ]);

        $pelanggan = Auth::guard('pelanggan')->user();

        if (!Hash::check($request->current_password, $pelanggan->password)) {
            return back()->withErrors(['current_password' => 'Password saat ini tidak cocok']);
        }

        try {
            // Use update method instead of save
            $result = Pelanggan::where('idpelanggan', $pelanggan->idpelanggan)
                ->update([
                    'password' => Hash::make($request->password),
                    'updated_at' => now(),
                ]);

            if ($result) {
                return redirect()->route('pelanggan.profile')->with('success', 'Password berhasil diperbarui!');
            } else {
                return back()->withErrors(['general' => 'Failed to update password. Please try again.']);
            }
        } catch (\Exception $e) {
            // Log the exception
            log::error('Error updating password: ' . $e->getMessage(), [
                'exception' => $e,
                'trace' => $e->getTraceAsString()
            ]);

            return back()->withErrors(['general' => 'An error occurred: ' . $e->getMessage()]);
        }
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'pelanggan' => 'required|string|max:255',
            'email' => 'required|string|email|unique:pelanggans',
            'alamat' => 'required|string|max:255',
            'telp' => 'required|string|max:255',
            'password' => 'required|string|confirmed|min:8',
        ]);
    
        try {
            $pelanggan = Pelanggan::create([
                'pelanggan' => $validated['pelanggan'],
                'email' => $validated['email'],
                'alamat' => $validated['alamat'],
                'telp' => $validated['telp'],
                'password' => Hash::make($validated['password']),
            ]);
    
            Auth::guard('pelanggan')->login($pelanggan);
    
            return redirect()->route('dashboard')->with('success', 'Registrasi berhasil!');
        } catch (\Exception $e) {
            return back()->withErrors(['general' => 'Registrasi gagal: '.$e->getMessage()]);
        }
    }
}
