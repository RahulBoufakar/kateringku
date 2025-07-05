<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    /**
     * Menampilkan daftar semua pesanan.
     */
    public function index()
    {
        $orders = Order::with('user')->latest()->paginate(15);
        return view('admin.orders.index', compact('orders'));
    }

    /**
     * Menampilkan detail satu pesanan.
     * Ini adalah halaman tempat admin melakukan konfirmasi.
     */
    public function show(Order $order)
    {
        // Eager load relasi untuk efisiensi query
        $order->load(['user', 'details.package', 'details.menuItem']);
        return view('admin.orders.show', compact('order'));
    }

    /**
     * Mengkonfirmasi pembayaran pesanan.
     */
    public function confirmPayment(Request $request, Order $order)
    {
        // Pastikan pesanan ada dan statusnya 'waiting_confirmation'
        if ($order && $order->status == 'waiting_confirmation') {
            $order->update(['status' => 'confirmed']);
            return redirect()->route('admin.orders.show', $order)->with('success', 'Pembayaran telah dikonfirmasi.');
        }

        return redirect()->route('admin.orders.show', $order)->with('error', 'Gagal mengkonfirmasi pembayaran.');
    }
}