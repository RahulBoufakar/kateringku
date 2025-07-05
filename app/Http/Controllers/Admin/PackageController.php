<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Package;
use App\Models\menu;
use Illuminate\Http\Request;

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
            'price_per_pax' => 'required|numeric',
            'min_order' => 'required|integer',
            'menu_items' => 'required|array' // Pastikan menu_items dikirim sebagai array
        ]);

        $package = Package::create($request->except('menu_items'));
        
        // Lampirkan menu item ke paket
        $package->menuItems()->attach($request->menu_items);

        return redirect()->route('admin.packages.index')->with('success', 'Paket berhasil dibuat.');
    }

    
}