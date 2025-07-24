<?php

namespace App\Http\Controllers\Admin;

use Storage;
use App\Models\menu;
use App\Models\Package;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage as StorageDisk;
use Illuminate\Support\Facades\Storage as StoragePackage;

class PackageController extends Controller
{
    public function index(){
        $packages = Package::all();
        return view('admin.packages.index', compact('packages'));
    }

    public function create()
    {
        $menuItems = menu::where('is_active', true)->get();
        return view('admin.packages.create', compact('menuItems'));
    }

    public function edit(Package $package)
{
        $menuItems = menu::where('is_active', true)->orderBy('nama_menu')->get();
        return view('admin.packages.edit', compact('package', 'menuItems'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'price_per_pax' => 'required|numeric',
            'min_order' => 'required|integer|min:1',
            'menu_items' => 'required|array',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048' // Gambar bersifat opsional
        ]);
        
        $imagePath = null;
        if ($request->hasFile('image')) {
            // Simpan gambar ke storage/app/public/package_images
            $imagePath = $request->file('image')->store('package_images', 'public');
        }
        
        $package = Package::create([
            'name' => $request->name,
            'description' => $request->description,
            'price_per_pax' => $request->price_per_pax,
            'min_order' => $request->min_order,
            'image_url' => $imagePath,
        ]);

        $package->menuItems()->attach($request->menu_items);

        return redirect()->route('admin.packages.index')->with('success', 'Paket berhasil dibuat.');
    }
    public function update(Request $request, Package $package)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'price_per_pax' => 'required|numeric',
            'min_order' => 'required|integer|min:1',
            'menu_items' => 'required|array', // Pastikan menu_items dikirim sebagai array
            'image_url' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048' // Gambar bersifat opsional
        ]);
        // Handle image upload if new image is provided
        if ($request->hasFile('image_url')) {
            // Hapus gambar sebelumnya jika ada
            if ($package->image_url && StorageDisk::disk('public')->exists($package->image_url)) {
                StorageDisk::disk('public')->delete($package->image_url);
            }

            // Simpan gambar baru
            $imagePath = $request->file('image_url')->store('package_images', 'public');
            $package->image_url = $imagePath;
        }

        // Update package with new data
        $package->update([
            'name' => $request->name,
            'description' => $request->description,
            'min_order' => $request->min_order,
            'price_per_pax' => $request->price_per_pax,
            'image_url' => $package->image_url, // Use the updated image path or keep existing
        ]);

        // Sync menu items to package
        $package->menuItems()->sync($request->menu_items);

        return redirect()->route('admin.packages.index')->with('success', 'Paket berhasil diperbarui.');
    }

    public function destroy(Package $package)
    {
        // Hapus gambar sebelum hapus
        if ($package->image_url && StorageDisk::disk('public')->exists($package->image_url)) {
            StorageDisk::disk('public')->delete($package->image_url);
        }
        $package->delete();

        return redirect()->route('admin.packages.index')->with('success', 'Paket berhasil dihapus.');
    }
}