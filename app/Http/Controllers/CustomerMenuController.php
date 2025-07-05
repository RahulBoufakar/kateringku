<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\menu;
use App\Models\Package;

class CustomerMenuController extends Controller
{
    public function index()
    {
        $packages = Package::where('is_active', true)->with('menuItems')->get();
        $menuItems = menu::where('is_active', true)->get()->groupBy('category');
        
        return view('menu', compact('packages', 'menuItems'));
    }
}
