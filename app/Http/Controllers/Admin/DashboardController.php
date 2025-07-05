<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\menu;
use App\Models\Order;
use App\Models\Package;

class DashboardController extends Controller
{
    public function index(){
        $countMenu = menu::count();
        $countOrder = Order::count();
        $countPackage = Package::count();

        return view('admin.dashboard', compact('countMenu', 'countOrder', 'countPackage'));
    }
}
