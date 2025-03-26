<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Order;
use App\Models\OrderDetail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class OrderController extends Controller
{
    public function index()
    {
        $user = Auth::guard('pelanggan')->user();
        if (!$user) {
            return redirect()->route('login')->with('error', 'Silakan login terlebih dahulu.');
        }

        // Ambil data keranjang user
        $cartItems = Cart::where('idpelanggan', $user->idpelanggan)
            ->with('menu')
            ->get();

        return view('order', compact('cartItems'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required_without:use_profile_data|string|max:255',
            'telp' => 'required_without:use_profile_data|string|max:15',
            'alamat' => 'required_without:use_profile_data|string|max:500',
            'use_profile_data' => 'sometimes|boolean',
        ]);
    
        try {
            $user = Auth::guard('pelanggan')->user();
            if (!$user) {
                return response()->json([
                    'success' => false,
                    'message' => 'Silakan login terlebih dahulu.'
                ], 401);
            }
    
            // Ambil data keranjang user
            $cartItems = Cart::where('idpelanggan', $user->idpelanggan)
                ->with('menu')
                ->get();
    
            if ($cartItems->isEmpty()) {
                return response()->json([
                    'success' => false,
                    'message' => 'Keranjang Anda kosong. Silakan tambahkan item terlebih dahulu.'
                ], 400);
            }
    
            // Determine which data to use
            $useProfileData = $request->boolean('use_profile_data', false);
            
            $customerName = $useProfileData ? $user->pelanggan : $request->name;
            $customerTelp = $useProfileData ? $user->telp : $request->telp;
            $customerAlamat = $useProfileData ? $user->alamat : $request->alamat;
    
            // Hitung total harga (termasuk biaya pengiriman Rp 10.000)
            $totalPrice = $cartItems->sum(function ($item) {
                return $item->menu->harga * $item->quantity;
            });
            $totalPrice += 10000; // Biaya pengiriman
    
            // Buat pesanan baru
            $order = Order::create([
                'idpelanggan' => $user->idpelanggan,
                'tglorder' => now()->toDateString(), // Tanggal saat ini
                'total' => $totalPrice,
                'bayar' => $totalPrice, // Asumsi bayar = total untuk saat ini
                'kembali' => 0, // Asumsi tidak ada kembalian
            ]);
    
            // Simpan detail pesanan ke order_details
            foreach ($cartItems as $cartItem) {
                OrderDetail::create([
                    'idorder' => $order->idorder,
                    'idmenu' => $cartItem->idmenu,
                    'jumlah' => $cartItem->quantity,
                    'hargajual' => $cartItem->menu->harga,
                ]);
            }
    
            // Kosongkan keranjang
            Cart::where('idpelanggan', $user->idpelanggan)->delete();
    
            Log::info('Pesanan berhasil dibuat:', ['idorder' => $order->idorder, 'idpelanggan' => $user->idpelanggan]);
    
            return response()->json([
                'success' => true,
                'message' => 'Pesanan berhasil dibuat!',
                'order_id' => $order->idorder, // Mengembalikan ID pesanan
            ]);
        } catch (\Exception $e) {
            Log::error('Gagal membuat pesanan:', ['error' => $e->getMessage()]);
            return response()->json([
                'success' => false,
                'message' => 'Gagal membuat pesanan. Silakan coba lagi.',
            ], 500);
        }
    }

    public function show()
    {
        // Pastikan user terautentikasi
        $user = Auth::guard('pelanggan')->user();
        if (!$user) {
            return redirect()->route('login')->with('error', 'Anda harus login terlebih dahulu.');
        }

        // Ambil data keranjang pengguna
        $cartItems = Cart::where('idpelanggan', $user->idpelanggan)->with('menu')->get();

        // Tampilkan halaman order
        return view('order', compact('cartItems'));
    }
}
