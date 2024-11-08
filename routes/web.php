<?php

use Illuminate\Support\Facades\Route;

use App\Models\User;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\PagesController;
use App\Http\Controllers\Admin\LaptopController;
use App\Http\Controllers\Admin\BrandController;
use App\Http\Controllers\Admin\PaymentController;
use App\Http\Controllers\Admin\CustomerController;
use App\Http\Controllers\LoginController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', [PagesController::class, 'getHome'])->name('home-page');
Route::get('/laptop/{id}', [PagesController::class, 'getSingleLaptop'])->name('single-laptop');
Route::get('/about', [PagesController::class, 'getAbout'])->name('about-page');
Route::get('/contact', [PagesController::class, 'getContact'])->name('contact-page');
Route::get('/wishlist', [PagesController::class, 'getWishlist'])->name('wishlist-page');
Route::get('/checkout', [PagesController::class, 'getCheckout'])->name('checkout-page');
Route::get('/cart', [PagesController::class, 'getCart'])->name('cart-page');
Route::get('/login', [PagesController::class, 'getLogin'])->name('login-page');
Route::get('/register', [PagesController::class, 'getRegister'])->name('register-page');
Route::get('/profile', [PagesController::class, 'getProfile'])->name('profile-page');

// Router Admin
Route::prefix('/admin')->group(function () {

    Route::get('/', [PagesController::class, 'getAdminDashboard'])->name('admin-dashboard-page');

    // Brand
    Route::prefix('/brand')->group(function () {
        Route::get('/get', [BrandController::class, 'getBrand'])->name('admin-getBrand');
        Route::get('/show', [BrandController::class, 'showBrand'])->name('admin-showBrand');
        Route::get('/add', [BrandController::class, 'addBrand'])->name('admin-addBrand');
        Route::post('/addHandle', [BrandController::class, 'addBrandHandle'])->name('admin-addBrand-handle');
        Route::get('/{id}/delete', [BrandController::class, 'destroy'])->name('admin-destroyBrand');
        Route::get('/{id}/edit', [BrandController::class, 'edit'])->name('admin-editBrand');
        Route::put('{id}/edit', [BrandController::class, 'update'])->name('admin-updateBrand');
    });

    // Laptop
    Route::prefix('/laptop')->group(function () {
        Route::get('get', [LaptopController::class, 'getLaptop'])->name('admin-getLaptop');
        Route::get('show', [LaptopController::class, 'showLaptop'])->name('admin-showLaptop');
        Route::get('add', [LaptopController::class, 'addLaptop'])->name('admin-addLaptop');
        Route::post('addHandle', [LaptopController::class, 'addLaptopHandle'])->name('admin-addLaptop-handle');
        Route::get('{id}/detail', [LaptopController::class, 'showDetailLaptop'])->name('admin-detailLaptop');
        Route::get('{id}/delete', [LaptopController::class, 'destroy'])->name('admin-destroyLaptop');
        Route::get('{id}/edit', [LaptopController::class, 'edit'])->name('admin-editLaptop');
        Route::put('{id}/edit', [LaptopController::class, 'update'])->name('admin-updateLaptop');
    });

    // Payment method
    Route::prefix('/payment')->group(function () {
        Route::get('/get', [PaymentController::class, 'getPayment'])->name('admin-getPayment');
        Route::get('/show', [PaymentController::class, 'showPayment'])->name('admin-showPayment');
        Route::get('/add', [PaymentController::class, 'addPayment'])->name('admin-addPayment');
        Route::post('/addHandle', [PaymentController::class, 'addPaymentHandle'])->name('admin-addPayment-handle');
        Route::get('{id}/delete', [PaymentController::class, 'destroy'])->name('admin-destroyPayment');
        Route::get('{id}/edit', [PaymentController::class, 'edit'])->name('admin-editPayment');
        Route::put('{id}/edit', [PaymentController::class, 'update'])->name('admin-updatePayment');
    });
});
