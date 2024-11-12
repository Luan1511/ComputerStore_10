<?php

use App\Http\Controllers\Admin\AccountController;
use GuzzleHttp\Middleware;
use Illuminate\Support\Facades\Route;

use App\Models\User;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\PagesController;
use App\Http\Controllers\Admin\LaptopController;
use App\Http\Controllers\Admin\BrandController;
use App\Http\Controllers\Admin\PaymentController;
use App\Http\Controllers\Admin\CustomerController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\WishListController;
use App\Http\Middleware\AuthAdmin;
use Illuminate\Auth\Events\Login;
use Illuminate\Routing\Router;
use Illuminate\Support\Facades\Auth;

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
Route::get('about', [PagesController::class, 'getAbout'])->name('about-page');
Route::get('contact', [PagesController::class, 'getContact'])->name('contact-page');

// Wishlist routes
Route::get('wishlist/{id}', [PagesController::class, 'getWishlist'])->name('wishlist-page');
Route::get('getWishlist', [WishListController::class, 'getWishlist'])->name('getWishlist');
Route::get('wishlist/{id}/add', [WishListController::class, 'add'])->name('addToWishlist');
Route::get('wishlist/{id}/delete', [WishListController::class, 'remove'])->name('removeFromWishlist');

// Cart routes
Route::get('cart/{id}', [PagesController::class, 'getCart'])->name('cart-page');
Route::get('getCart', [CartController::class, 'getCart'])->name('getCart');
Route::get('cart/{id}/addSingle', [CartController::class, 'addSingle'])->name('addSingleToCart');
Route::get('cart/{id}/delete', [CartController::class, 'remove'])->name('removeFromCart');

Route::get('checkout', [PagesController::class, 'getCheckout'])->name('checkout-page');
Route::get('cart', [PagesController::class, 'getCart'])->name('cart-page');
Route::get('login', [LoginController::class, 'getLogin'])->name('login-page');
Route::post('login', [LoginController::class, 'postLogin'])->name('post-login');
Route::get('register', [LoginController::class, 'getRegister'])->name('register-page');
Route::post('register', [LoginController::class, 'postRegister'])->name('post-register');
Route::get('profile', [PagesController::class, 'getProfile'])->name('profile-page');
Route::get('logout', [LoginController::class, 'getLogout'])->name('logout');
Route::post('check_login', [PagesController::class, 'check_login']);
Route::get('loginAdmin', [LoginController::class, 'getLoginAdmin'])->name('loginAdmin');
Route::post('loginAdmin', [LoginController::class, 'postLoginAdmin'])->name('loginAdmin');
Route::get('laptop/{id}', [PagesController::class, 'getSingleLaptop'])->name('single-laptop');
Route::post('send-email', [ContactController::class, 'sendEmail'])->name('send.email');

// Router Admin
Route::middleware('admin')->group(function () {
    Route::prefix('admin')->group(function () {

        Route::get('/', [PagesController::class, 'getAdminDashboard'])->name('admin-dashboard-page');

        // Brand
        Route::prefix('brand')->group(function () {
            Route::get('get', [BrandController::class, 'getBrand'])->name('admin-getBrand');
            Route::get('show', [BrandController::class, 'showBrand'])->name('admin-showBrand');
            Route::get('add', [BrandController::class, 'addBrand'])->name('admin-addBrand');
            Route::post('addHandle', [BrandController::class, 'addBrandHandle'])->name('admin-addBrand-handle');
            Route::get('{id}/delete', [BrandController::class, 'destroy'])->name('admin-destroyBrand');
            Route::get('{id}/edit', [BrandController::class, 'edit'])->name('admin-editBrand');
            Route::put('{id}/edit', [BrandController::class, 'update'])->name('admin-updateBrand');
        });

        // Account
        Route::prefix('account')->group(function () {
            Route::get('get', [AccountController::class, 'getAccount'])->name('admin-getAccount');
            Route::get('show', [AccountController::class, 'showAccount'])->name('admin-showAccount');
            Route::get('{id}/delete', [AccountController::class, 'destroy'])->name('admin-destroyAccount');
        });

        // Laptop
        Route::prefix('laptop')->group(function () {
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
        Route::prefix('payment')->group(function () {
            Route::get('get', [PaymentController::class, 'getPayment'])->name('admin-getPayment');
            Route::get('show', [PaymentController::class, 'showPayment'])->name('admin-showPayment');
            Route::get('add', [PaymentController::class, 'addPayment'])->name('admin-addPayment');
            Route::post('addHandle', [PaymentController::class, 'addPaymentHandle'])->name('admin-addPayment-handle');
            Route::get('{id}/delete', [PaymentController::class, 'destroy'])->name('admin-destroyPayment');
            Route::get('{id}/edit', [PaymentController::class, 'edit'])->name('admin-editPayment');
            Route::put('{id}/edit', [PaymentController::class, 'update'])->name('admin-updatePayment');
        });
    });
});
