<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\OrderDetail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log as log;

class OrderDetailController extends Controller
{
    public function index(Request $request)
    {
        $status = $request->query('status');
        
        $query = OrderDetail::with('menu')
            ->orderBy('created_at', 'desc')
            ->take(10);
            
        if ($status) {
            $query->where('status', $status);
        } else {
            $query->where('status', '!=', 'Cancelled');
        }
        
        $recentOrders = $query->get()->groupBy('idorder');
        
        return view('admin.dashboard', compact('recentOrders'));
    }

    public function store(Request $request)
    {
        // Validasi input dari form
        $request->validate([
            'name' => 'required|string|max:255',
            'telp' => 'required|string|max:15', // Tetap validasi, tapi tidak disimpan
            'alamat' => 'required|string|max:255',
        ]);

        // Pastikan user terautentikasi
        $user = Auth::guard('pelanggan')->user();
        if (!$user) {
            return redirect()->route('login')->with('error', 'Anda harus login terlebih dahulu.');
        }

        // Debugging: Periksa idpelanggan
        if (empty($user->idpelanggan)) {
            log::error('User idpelanggan is empty', ['user' => $user]);
            return redirect()->route('order.show')->with('error', 'ID Pelanggan tidak ditemukan. Silakan hubungi admin.');
        }

        // Ambil data keranjang pengguna
        $cartItems = Cart::where('idpelanggan', $user->idpelanggan)->with('menu')->get();

        // Jika keranjang kosong
        if ($cartItems->isEmpty()) {
            return redirect()->route('order.show')->with('error', 'Keranjang Anda kosong. Silakan tambahkan item terlebih dahulu.');
        }

        try {
            // Gunakan transaksi untuk memastikan data tersimpan dengan baik
            DB::beginTransaction();

            // Generate satu ID order untuk semua item
            $orderId = 'ORD-' . time();

            // Hitung subtotal
            $subtotal = $cartItems->sum(function($item) {
                return $item->menu->harga * $item->quantity;
            });

            // Total dengan ongkir
            $total = $subtotal + 10000; // Ongkir 10.000

            // Simpan setiap item keranjang ke order_details
            foreach ($cartItems as $item) {
                OrderDetail::create([
                    'idorder' => $orderId,
                    'idpelanggan' => $user->idpelanggan,
                    'idmenu' => $item->menu->idmenu,
                    'pelanggan' => $request->name,
                    'alamat' => $request->alamat,
                    'quantity' => $item->quantity,
                    'total' => $item->menu->harga * $item->quantity,
                    'status' => 'Pending',
                    'id_transaksi' => null,
                ]);
            }

            // Kosongkan keranjang setelah pesanan berhasil
            Cart::where('idpelanggan', $user->idpelanggan)->delete();

            DB::commit();

            // Redirect ke route order.show dengan session success dan order_id
            return redirect()->route('order.show')->with([
                'success' => true,
                'order_id' => $orderId
            ]);
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->route('order.show')->with('error', 'Terjadi kesalahan saat memproses pesanan: ' . $e->getMessage());
        }
    }

    public function cancelOrder($orderId)
    {
        try {
            $user = Auth::guard('pelanggan')->user();
            if (!$user) {
                return redirect()->route('login')->with('error', 'Anda harus login terlebih dahulu.');
            }

            // Cari pesanan yang akan dibatalkan
            $orders = OrderDetail::where('idorder', $orderId)
                ->where('idpelanggan', $user->idpelanggan)
                ->get();

            if ($orders->isEmpty()) {
                return redirect()->route('order.history')->with('error', 'Pesanan tidak ditemukan.');
            }

            // Hanya bisa membatalkan jika status masih Pending
            if ($orders->first()->status != 'Pending') {
                return redirect()->route('order.history')->with('error', 'Pesanan sudah diproses dan tidak dapat dibatalkan.');
            }

            DB::beginTransaction();

            // Update status pesanan menjadi 'Cancelled'
            OrderDetail::where('idorder', $orderId)
                ->where('idpelanggan', $user->idpelanggan)
                ->update(['status' => 'Cancelled']);

            DB::commit();

            return redirect()->route('order.history')->with('success', 'Pesanan berhasil dibatalkan.');
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->route('order.history')->with('error', 'Gagal membatalkan pesanan: ' . $e->getMessage());
        }
    }
    
    public function updateStatus(Request $request)
    {
        // Validate the request data
        $request->validate([
            'order_id' => 'required|string', // Changed to string since idorder is varchar
            'status' => 'required|in:Pending,In Transit,Out for Delivery,Delivered,Cancelled',
        ]);
    
        try {
            // Find all order details with the given idorder and update their status
            $updated = OrderDetail::where('idorder', $request->order_id)
                ->update(['status' => $request->status]);
            
            if ($updated) {
                return response()->json(['success' => true, 'message' => 'Order status updated successfully']);
            } else {
                return response()->json(['success' => false, 'message' => 'No orders found with the given ID']);
            }
        } catch (\Exception $e) {
            // Log the error for debugging purposes
            Log::error('Failed to update order status', ['error' => $e->getMessage()]);
    
            return response()->json(['success' => false, 'message' => 'Failed to update order status: ' . $e->getMessage()]);
        }
    }
}
