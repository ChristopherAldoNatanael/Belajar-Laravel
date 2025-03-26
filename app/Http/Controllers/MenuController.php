<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use App\Models\Cart;
use App\Models\Menu;
use App\Models\Kategori;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use App\Http\Requests\StoreMenuRequest;
use App\Http\Requests\UpdateMenuRequest;

class MenuController extends Controller
{

    public function index()
    {
        // Load relasi kategori saat mengambil data menu
        $menus = Menu::with('kategori')->get();
        return view('menu', compact('menus'));
    }

    public function addToCart(Request $request)
    {
        // Pastikan user sudah login
        if (!Auth::guard('pelanggan')->check()) {
            return response()->json([
                'success' => false,
                'message' => 'Silakan login terlebih dahulu untuk menambahkan ke keranjang',
                'redirect' => route('login')
            ], 401);
        }

        // Log data yang diterima
        Log::info('Data diterima di addToCart:', $request->all());

        // Validasi input
        try {
            $validated = $request->validate([
                'menu_id' => 'required|exists:menus,idmenu',
                'quantity' => 'required|integer|min:1|max:99',
            ]);
        } catch (\Illuminate\Validation\ValidationException $e) {
            Log::error('Validasi gagal:', $e->errors());
            return response()->json([
                'success' => false,
                'message' => 'Validasi gagal: ' . implode(', ', $e->errors()['menu_id'] ?? $e->errors()['quantity'] ?? ['Unknown error']),
            ], 422);
        }

        $menuId = $request->input('menu_id');
        $quantity = $request->input('quantity');
        $pelangganId = Auth::guard('pelanggan')->id();

        Log::info('User ID:', ['pelanggan_id' => $pelangganId]);
        Log::info('Menu ID:', ['menu_id' => $menuId]);
        Log::info('Quantity:', ['quantity' => $quantity]);

        // Cek apakah item sudah ada di keranjang
        $cartItem = Cart::where('pelanggan_id', $pelangganId)
            ->where('menu_id', $menuId)
            ->first();

        if ($cartItem) {
            // Jika sudah ada, tambahkan quantity
            $cartItem->quantity += $quantity;
            $cartItem->save();
            Log::info('Item diupdate di keranjang:', ['cart_id' => $cartItem->id, 'new_quantity' => $cartItem->quantity]);
        } else {
            // Jika belum ada, buat item baru di keranjang
            $cartItem = Cart::create([
                'pelanggan_id' => $pelangganId,
                'menu_id' => $menuId,
                'quantity' => $quantity,
            ]);
            Log::info('Item baru ditambahkan ke keranjang:', ['cart_id' => $cartItem->id]);
        }

        return response()->json([
            'success' => true,
            'message' => 'Item berhasil ditambahkan ke keranjang!',
        ]);
    }

    public function showCart()
    {
        $cartItems = Cart::where('pelanggan_id', Auth::guard('pelanggan')->id())
            ->with('menu')
            ->get();
        return view('cart', compact('cartItems'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreMenuRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Menu $menu)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Menu $menu)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateMenuRequest $request, Menu $menu)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Menu $menu)
    {
        //
    }
}
