<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\CustomerMenuController; // Controller baru
use App\Http\Controllers\OrderController;
use App\Http\Controllers\Admin\DashboardController as AdminDashboardController;
use App\Http\Controllers\Admin\MenuController as AdminMenuController;
use App\Http\Controllers\Admin\PackageController as AdminPackageController;
use App\Http\Controllers\PackageController; // Jangan lupa tambahkan ini di atas
use App\Http\Controllers\Admin\OrderController as AdminOrderController;
use App\Http\Controllers\CartController;
use App\Models\Package;

// Halaman utama untuk user memilih menu
// Di landing page Anda, tombol "Pesan" harus mengarah ke route ini.
Route::get('/', function(){
    return view('index');
})->name('index');

//display contac information
Route::get('/kontak', function () {
    return view('contact');
})->name('contact');

//display menu
Route::get('/menu', [CustomerMenuController::class, 'index'])->name('menu');

//show menu in package
Route::get('/paket/{package}', [PackageController::class, 'show'])->name('packages.show');

// Rute yang memerlukan login (User Biasa & Admin)
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    
    // Proses Pemesanan
    Route::post('/order/place-package', [OrderController::class, 'placePackageOrder'])->name('order.place.package');
    // Anda bisa tambahkan route untuk order a la carte di sini nanti
    Route::get('/my-orders', [OrderController::class, 'index'])->name('order.index');
    Route::get('/my-orders/{order}', [OrderController::class, 'show'])->name('order.show');
    Route::post('/my-orders/{order}/pay', [OrderController::class, 'uploadProof'])->name('order.upload_proof');

    // Rute Keranjang Belanja
    Route::get('/cart', [CartController::class, 'show'])->name('cart.show');
    Route::post('/cart/add', [CartController::class, 'add'])->name('cart.add');
    Route::post('/cart/remove', [CartController::class, 'remove'])->name('cart.remove');
    Route::post('/order/place-cart', [OrderController::class, 'placeCartOrder'])->name('order.place.cart');
});


// Rute Khusus Admin
Route::middleware(['auth'])->prefix('admin')->name('admin.')->group(function() {
    Route::get('/dashboard', [AdminDashboardController::class, 'index'])->name('dashboard');
    
    Route::resource('menus', AdminMenuController::class);
    Route::resource('packages', AdminPackageController::class);

    Route::get('orders', [AdminOrderController::class, 'index'])->name('orders.index');
    Route::get('orders/{order}', [AdminOrderController::class, 'show'])->name('orders.show');
    Route::post('orders/{order}/confirm', [AdminOrderController::class, 'confirmPayment'])->name('orders.confirm_payment');
});


require __DIR__.'/auth.php';