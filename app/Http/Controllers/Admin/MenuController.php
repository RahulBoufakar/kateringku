<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\menu;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class MenuController extends Controller
{
    /**
     * Menampilkan daftar semua menu.
     */
    public function index()
    {
        // Ambil semua menu dengan paginasi
        $menus = menu::latest()->paginate(10);
        return view('admin.menu.index', compact('menus'));
    }

    /**
     * Menampilkan form untuk membuat menu baru.
     */
    public function create()
    {
        return view('admin.menu.create');
    }

    /**
     * Menyimpan menu baru ke database.
     */
    public function store(Request $request)
    {
        // Validasi input
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'category' => 'required|string',
            'price' => 'required|numeric',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048' // Gambar bersifat opsional
        ]);

        $imagePath = null;
        if ($request->hasFile('image')) {
            // Simpan gambar ke storage/app/public/menu_images
            $imagePath = $request->file('image')->store('menu_images', 'public');
        }

        menu::create([
            'nama_menu' => $request->name,
            'deskripsi' => $request->description,
            'kategori' => $request->category,
            'harga' => $request->price,
            'gambar' => $imagePath,
            'is_active' => true,
        ]);

        return redirect()->route('admin.menus.index')->with('success', 'Menu berhasil ditambahkan.');
    }

    /**
     * Menampilkan form untuk mengedit menu.
     */
    public function edit(menu $menu)
    {
        $menuItem = $menu;
        return view('admin.menu.edit', compact('menuItem'));
    }

    /**
     * Mengupdate data menu di database.
     */
    public function update(Request $request, menu $menu)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'category' => 'required|string',
            'price' => 'required|numeric',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048'
        ]);

        $imagePath = $menu->image_url; // Gunakan gambar lama sebagai default

        if ($request->hasFile('image')) {
            // Jika ada gambar lama, hapus
            if ($menu->image_url) {
                Storage::disk('public')->delete($menu->image_url);
            }
            // Upload gambar baru
            $imagePath = $request->file('image')->store('menu_images', 'public');
        }

        $menu->update([
            'nama_menu' => $request->name,
            'deskripsi' => $request->description,
            'kategori' => $request->category,
            'harga' => $request->price,
            'gambar' => $imagePath,
        ]);

        return redirect()->route('admin.menus.index')->with('success', 'Menu berhasil diperbarui.');
    }

    /**
     * Menghapus menu dari database.
     */
    public function destroy(menu $menu)
    {
        // Hapus gambar terkait jika ada
        if ($menu->image_url) {
            Storage::disk('public')->delete($menu->image_url);
        }

        $menu->delete();

        return redirect()->route('admin.menus.index')->with('success', 'Menu berhasil dihapus.');
    }
}