<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Cart;
use App\Models\Menu;
use Illuminate\Support\Facades\Auth;

class CartController extends Controller
{
    // Menampilkan halaman keranjang belanja
    public function index()
    {
        $user = Auth::guard('pelanggan')->user();

        if ($user) {
            $cartItems = Cart::where('idpelanggan', $user->idpelanggan)
                ->with('menu')
                ->get();
        } else {
            $cartItems = collect(); // Koleksi kosong jika tidak ada user
        }

        return view('cart', compact('cartItems'));
    }

    // Menambahkan item ke keranjang
    public function add(Request $request)
    {
        $request->validate([
            'menu_id' => 'required|exists:menus,idmenu',
            'quantity' => 'required|integer|min:1|max:99',
        ]);

        $user = Auth::guard('pelanggan')->user();
        $cartItem = Cart::where('idpelanggan', $user->idpelanggan)
            ->where('idmenu', $request->menu_id)
            ->first();

        if ($cartItem) {
            $cartItem->quantity += $request->quantity;
            $cartItem->save();
            $message = 'Jumlah item di keranjang diperbarui!';
        } else {
            Cart::create([
                'idpelanggan' => $user->idpelanggan,
                'idmenu' => $request->menu_id,
                'quantity' => $request->quantity,
            ]);
            $message = 'Item berhasil ditambahkan ke keranjang!';
        }

        return response()->json([
            'success' => true,
            'message' => $message,
        ]);
    }

    // Menghapus item dari keranjang
    public function remove($id)
    {
        $user = Auth::guard('pelanggan')->user();
        $cartItem = Cart::where('idpelanggan', $user->idpelanggan)
            ->where('id', $id)
            ->first();

        if ($cartItem) {
            $cartItem->delete();
            return response()->json([
                'success' => true,
                'message' => 'Item berhasil dihapus dari keranjang!'
            ]);
        }

        return response()->json([
            'success' => false,
            'message' => 'Item tidak ditemukan di keranjang!'
        ], 404);
    }

    // Memperbarui jumlah item di keranjang
    public function update(Request $request, $id)
    {
        $request->validate([
            'quantity' => 'required|integer|min:1|max:99',
        ]);

        $user = Auth::guard('pelanggan')->user();
        $cartItem = Cart::where('idpelanggan', $user->idpelanggan)
            ->where('id', $id)
            ->first();

        if ($cartItem) {
            $cartItem->quantity = $request->quantity;
            $cartItem->save();

            // Hitung total harga untuk item ini
            $newTotal = $cartItem->menu->harga * $cartItem->quantity;

            // Hitung total harga semua item di keranjang
            $cartTotal = Cart::where('idpelanggan', $user->idpelanggan)
                ->with('menu')
                ->get()
                ->sum(function ($item) {
                    return $item->menu->harga * $item->quantity;
                });

            return response()->json([
                'success' => true,
                'message' => 'Jumlah item berhasil diperbarui!',
                'new_total' => $newTotal,
                'cart_total' => $cartTotal
            ]);
        }

        return response()->json([
            'success' => false,
            'message' => 'Item tidak ditemukan di keranjang!'
        ], 404);
    }
}
