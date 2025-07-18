<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\OrderDetail;
use App\Models\Package;
use Illuminate\Support\Facades\Auth;

class OrderController extends Controller
{
    // Untuk menampilkan riwayat pesanan user
    public function index()
    {
        $orders = Order::where('user_id', Auth::user()->id)->get();
        return view('orders.index', compact('orders'));
    }
    
    // Untuk menampilkan detail pesanan
    public function show(Order $order)
    {
        // Pastikan user hanya bisa melihat order miliknya
        if ($order->user_id !== Auth::id()) {
            abort(403);
        }
        return view('orders.show', compact('order'));
    }

    // Logika membuat pesanan (disederhanakan)
    public function placeOrder(Request $request)
    {
        $request->validate([
            'package_id' => 'required|exists:packages,id',
            'num_of_pax' => 'required|integer|min:1',
            'event_date' => 'required|date',
            'shipping_address' => 'required|string',
        ]);

        $package = Package::findOrFail($request->package_id);
        
        // Validasi minimum order
        if($request->num_of_pax < $package->min_order) {
            return back()->withErrors(['num_of_pax' => 'Jumlah pesanan kurang dari minimum order paket ini.']);
        }

        $totalPrice = $package->price_per_pax * $request->num_of_pax;

        $order = Order::create([
            'user_id' => Auth::id(),
            'event_date' => $request->event_date,
            'num_of_pax' => $request->num_of_pax,
            'total_price' => $totalPrice,
            'shipping_address' => $request->shipping_address,
            'status' => 'waiting_payment',
        ]);
        
        // Simpan detailnya
        OrderDetail::create([
            'order_id' => $order->id,
            'package_id' => $package->id,
            'quantity' => $request->num_of_pax,
            'price' => $package->price_per_pax,
        ]);

        return redirect()->route('order.show', $order)->with('success', 'Pesanan berhasil dibuat. Silakan lakukan pembayaran.');
    }
    
    // Logika upload bukti bayar
    public function uploadProof(Request $request, Order $order)
    {
        $request->validate(['payment_proof' => 'required|image|max:2048']);

        // Pastikan user hanya bisa bayar order miliknya
        if ($order->user_id !== Auth::id()) {
            abort(403);
        }

        // Simpan file
        $path = $request->file('payment_proof')->store('payment_proofs', 'public');

        $order->update([
            'payment_proof' => $path,
            'status' => 'waiting_confirmation'
        ]);
        
        return redirect()->route('order.show', $order)->with('success', 'Bukti pembayaran berhasil diupload. Mohon tunggu konfirmasi dari admin.');
    }
    /**
     * Membuat pesanan dari PAKET KATERING.
     */
    public function placePackageOrder(Request $request)
    {
        $request->validate([
            'package_id' => 'required|exists:packages,id',
            'num_of_pax' => 'required|integer|min:1',
            'event_date' => 'required|date|after_or_equal:today',
            'shipping_address' => 'required|string',
        ]);

        $package = Package::findOrFail($request->package_id);
        if($request->num_of_pax < $package->min_order) {
            return back()->withErrors(['num_of_pax' => 'Jumlah pesanan kurang dari minimum order paket ini.'])->withInput();
        }

        $totalPrice = $package->price_per_pax * $request->num_of_pax;

        // Buat Order Utama
        $order = Order::create([
            'user_id' => Auth::id(),
            'event_date' => $request->event_date,
            'num_of_pax' => $request->num_of_pax,
            'total_price' => $totalPrice,
            'shipping_address' => $request->shipping_address,
            'status' => 'waiting_payment',
        ]);
        
        // Buat Detail Order
        OrderDetail::create([
            'order_id' => $order->id,
            'package_id' => $package->id,
            'quantity' => $request->num_of_pax, // Untuk paket, quantity adalah jumlah pax
            'price' => $package->price_per_pax,
        ]);

        return redirect()->route('order.show', $order)->with('success', 'Pesanan paket berhasil dibuat. Silakan lakukan pembayaran.');
    }

    /**
     * Membuat pesanan dari KERANJANG BELANJA (A LA CARTE).
     */
    public function placeCartOrder(Request $request)
    {
        $request->validate([
            'event_date' => 'required|date|after_or_equal:today',
            'shipping_address' => 'required|string',
        ]);
        
        $cart = $request->session()->get('cart');

        // Jika keranjang kosong, kembalikan
        if (!$cart) {
            return redirect()->route('cart.show')->with('error', 'Keranjang Anda kosong.');
        }

        // Hitung total harga dari keranjang
        $totalPrice = 0;
        foreach ($cart as $details) {
            $totalPrice += $details['price'] * $details['quantity'];
        }

        // Buat Order Utama
        $order = Order::create([
            'user_id' => Auth::id(),
            'event_date' => $request->event_date,
            'num_of_pax' => 0, // Untuk a la carte, pax bisa dianggap 0 atau dihitung beda
            'total_price' => $totalPrice,
            'shipping_address' => $request->shipping_address,
            'status' => 'waiting_payment',
        ]);
        
        // Buat Detail Order untuk setiap item di keranjang
        foreach ($cart as $id => $details) {
            OrderDetail::create([
                'order_id' => $order->id,
                'menu_item_id' => $id,
                'quantity' => $details['quantity'], // Untuk a la carte, quantity adalah jumlah porsi
                'price' => $details['price'],
            ]);
        }

        // Kosongkan keranjang setelah order dibuat
        $request->session()->forget('cart');

        return redirect()->route('order.show', $order)->with('success', 'Pesanan menu berhasil dibuat. Silakan lakukan pembayaran.');
    }
}