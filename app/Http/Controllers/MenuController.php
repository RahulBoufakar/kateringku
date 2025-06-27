<?php

namespace App\Http\Controllers;

use App\Models\menu;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class MenuController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Fetch all menu items from the database
        $menu = Menu::all();
        return view('admin.menu.index', compact('menu'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        // Return the view for creating a new menu item
        return view('menu.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Validate the request data
        $data = $request->validate([
            'nama_menu' => 'required|string|max:255|unique:menu',
            'deskripsi' => 'nullable|text',
            'harga' => 'required|numeric|min:0',
            'gambar' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:5120',
            'kategori' => 'nullable|string|max:255',
        ]);

        // Handle image upload if a file is provided
        if ($request->hasFile('gambar')) {
            $data['gambar'] = $request->file('gambar')->store('images', 'public');
        }

        // Create the menu item with the validated data
        Menu::create($data);

        // Redirect back to the menu index with a success message
        return redirect()->route('menu.index')->with('success', 'Menu created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(menu $menu)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(menu $menu)
    {
        // Return the view for editing the specified menu item
        return view('menu.edit', compact('menu'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, menu $menu)
    {
        // Validate the request data
        $data = $request->validate([
            'nama_menu' => 'required|string|max:255|unique:menu,nama_menu,' . $menu->id,
            'deskripsi' => 'nullable|text',
            'harga' => 'required|numeric|min:0',
            'gambar' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:5120',
            'kategori' => 'nullable|string|max:255',
        ]);

        // Only handle image upload if a new image is provided
        if ($request->hasFile('gambar')) {
            // Delete the old image if it exists
            if ($menu->gambar) {
                Storage::disk('public')->delete($menu->gambar);
            }
            // Store the new image
            $data['gambar'] = $request->file('gambar')->store('images', 'public');
        } else {
            // If no new image, keep the old image path
            unset($data['gambar']);
        }

        // Update the menu item with the validated data
        $menu->update($data);

        // Redirect back to the menu index with a success message
        return redirect()->route('menu.index')->with('success', 'Menu updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(menu $menu)
    {
        // Delete the menu item from the database
        $menu->delete();

        // If the menu item has an image, delete it from storage
        if ($menu->gambar) {
            Storage::disk('public')->delete($menu->gambar);
        }

        // Redirect back to the menu index with a success message
        return redirect()->route('menu.index')->with('success', 'Menu deleted successfully.');
    }
}
