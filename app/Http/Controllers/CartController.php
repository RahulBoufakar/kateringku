<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\menu;

class CartController extends Controller
{
    // Menampilkan halaman keranjang belanja
    public function show(Request $request)
    {
        $cart = $request->session()->get('cart', []);
        return view('cart', compact('cart'));
    }

    // Menambah item ke keranjang
    public function add(Request $request)
    {
        // dd($request);
        $request->validate([
            'menu_item_id' => 'required|exists:menu,id',
            'quantity' => 'required|integer|min:1'
        ]);

        $menuItem = menu::findOrFail($request->menu_item_id);
        $cart = $request->session()->get('cart', []);
        
        // Jika item sudah ada di keranjang, tambahkan quantity-nya
        if(isset($cart[$menuItem->id])) {
            $cart[$menuItem->id]['quantity'] += $request->quantity;
        } else {
            // Jika item baru, tambahkan ke keranjang
            $cart[$menuItem->id] = [
                "name" => $menuItem->nama_menu,
                "quantity" => $request->quantity,
                "price" => $menuItem->harga,
                "image_url" => $menuItem->gambar
            ];
        }
        // Simpan kembali cart ke session
        $request->session()->put('cart', $cart);

        return redirect()->back()->with('success', 'Menu berhasil ditambahkan ke keranjang!');
    }

    // Menghapus item dari keranjang
    public function remove(Request $request)
    {
        $request->validate(['menu_item_id' => 'required|exists:menu,id']);

        $cart = $request->session()->get('cart', []);

        if(isset($cart[$request->menu_item_id])) {
            unset($cart[$request->menu_item_id]);
            $request->session()->put('cart', $cart);
        }

        return redirect()->back()->with('success', 'Menu berhasil dihapus dari keranjang.');
    }
}