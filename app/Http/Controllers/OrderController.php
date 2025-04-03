<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\OrderDetail;
use App\Models\Menu;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class OrderController extends Controller
{
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

    public function history()
    {
        // Get the authenticated user
        $user = Auth::guard('pelanggan')->user();
        if (!$user) {
            return redirect()->route('login')->with('error', 'Please login to view your order history.');
        }

        // Get all order details for this user
        $orderDetails = OrderDetail::where('idpelanggan', $user->idpelanggan)
            ->with('menu')  // Ensure this relationship is defined in OrderDetail model
            ->orderBy('created_at', 'desc')
            ->get();

        // Group order details by order ID
        $groupedOrders = [];
        foreach ($orderDetails as $detail) {
            if (!isset($groupedOrders[$detail->idorder])) {
                $groupedOrders[$detail->idorder] = collect();
            }
            $groupedOrders[$detail->idorder]->push($detail);
        }

        // Debug information
        Log::info('Order history for user ' . $user->idpelanggan . ':', [
            'total_details' => $orderDetails->count(),
            'unique_orders' => count($groupedOrders)
        ]);

        // Return the view with the grouped orders
        return view('order.history', compact('groupedOrders'));
    }
}
