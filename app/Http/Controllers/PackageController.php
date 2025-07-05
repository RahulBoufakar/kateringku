<?php

namespace App\Http\Controllers;

use App\Models\Package;
use Illuminate\Http\Request;

class PackageController extends Controller
{
    /**
     * Menampilkan halaman detail untuk satu paket.
     */
    public function show(Package $package)
    {
        // Eager load menuItems untuk query yang lebih efisien
        $package->load('menuItems'); 
        
        return view('packages.show', compact('package'));
    }
}