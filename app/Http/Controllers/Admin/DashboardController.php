<?php

namespace App\Http\Controllers\Admin;

use Carbon\Carbon;
use App\Models\menu;
use App\Models\Order;
use App\Models\Package;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class DashboardController extends Controller
{
    public function index()
    {
        $countMenu = Menu::count();
        $countOrder = Order::count();
        $countPackage = Package::count();

        $monthlyRevenue = Order::whereYear('created_at', now()->year)->whereMonth('created_at', now()->month)->sum('total_price');

        // Get monthly sales data for current year
        $monthlySales = Order::selectRaw('MONTH(created_at) as month, SUM(total_price) as total')->whereYear('created_at', now()->year)->groupBy('month')->orderBy('month')->get();

        $chartLabels = [];
        $chartData = [];

        // Fill all 12 months to avoid gaps
        for ($i = 1; $i <= 12; $i++) {
            $label = Carbon::create()->month($i)->format('F');
            $chartLabels[] = $label;

            $monthSale = $monthlySales->firstWhere('month', $i);
            $chartData[] = $monthSale ? $monthSale->total : 0;
        }

        return view('admin.dashboard', compact('countMenu', 'countOrder', 'countPackage', 'monthlyRevenue', 'chartLabels', 'chartData'));
    }
}
