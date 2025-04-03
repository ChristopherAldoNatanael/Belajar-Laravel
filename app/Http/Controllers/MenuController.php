<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use App\Models\Cart;
use App\Models\Menu;
use App\Models\Kategori;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use App\Http\Requests\StoreMenuRequest;
use App\Http\Requests\UpdateMenuRequest;

class MenuController extends Controller
{
    public function index()
    {
        $menus = Menu::with('kategori')->get();
        return view('menu', compact('menus'));
    }

    public function adminIndex()
    {
        $menus = Menu::with('kategori')->get();
        $kategoris = Kategori::all();
        return view('admin.menus.index', compact('menus', 'kategoris'));
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
        $kategoris = Kategori::all();
        return view('admin.menus.create', compact('kategoris'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'menu' => 'required|string|max:255',
            'idkategori' => 'required|exists:kategoris,idkategori',
            'harga' => 'required|numeric|min:0',
            'deskripsi' => 'nullable|string',
            'gambar' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);
        
        // Handle image upload if present
        if ($request->hasFile('gambar')) {
            $imageName = time().'.'.$request->gambar->extension();  
            $request->gambar->move(public_path('gambar'), $imageName);
            $validated['gambar'] = $imageName;
        }
        
        Menu::create($validated);
        
        return redirect()->route('admin.menu-management.index')
            ->with('success', 'Menu created successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show(Menu $menu)
    {
        return view('admin.menus.show', compact('menu'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $menu = Menu::findOrFail($id);
        return response()->json([
            'menu' => $menu,
            'selected_kategori' => $menu->idkategori
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $menu = Menu::findOrFail($id);
        
        $validated = $request->validate([
            'menu' => 'required|string|max:255',
            'idkategori' => 'required|exists:kategoris,idkategori',
            'harga' => 'required|numeric|min:0',
            'deskripsi' => 'nullable|string',
            'gambar' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);
        
        // Handle image upload if present
        if ($request->hasFile('gambar')) {
            // Delete old image if exists
            if ($menu->gambar && file_exists(public_path('gambar/' . $menu->gambar))) {
                unlink(public_path('gambar/' . $menu->gambar));
            }
            
            $imageName = time().'.'.$request->gambar->extension();  
            $request->gambar->move(public_path('gambar'), $imageName);
            $validated['gambar'] = $imageName;
        }
        
        $menu->update($validated);
        
        return redirect()->route('admin.menu-management.index')
            ->with('success', 'Menu updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $menu = Menu::findOrFail($id);
        
        // Delete the image file if it exists
        if ($menu->gambar && file_exists(public_path('gambar/' . $menu->gambar))) {
            unlink(public_path('gambar/' . $menu->gambar));
        }
        
        $menu->delete();
        
        return redirect()->route('admin.menu-management.index')
            ->with('success', 'Menu deleted successfully');
    }
}
