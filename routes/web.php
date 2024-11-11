<?php

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
use App\Http\Controllers\LoginController;
use App\Http\Controllers\UserController;
use App\Http\Middleware\AuthAdmin;
use Illuminate\Auth\Events\Login;
use Illuminate\Routing\Router;
use Illuminate\Support\Facades\Auth;


Auth::routes();


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
Route::get('/about', [PagesController::class, 'getAbout'])->name('about-page');
Route::get('/contact', [PagesController::class, 'getContact'])->name('contact-page');
Route::get('/wishlist', [PagesController::class, 'getWishlist'])->name('wishlist-page');
Route::get('/checkout', [PagesController::class, 'getCheckout'])->name('checkout-page');
Route::get('/cart', [PagesController::class, 'getCart'])->name('cart-page');
Route::get('/login', [LoginController::class, 'getLogin'])->name('login-page');
Route::post('/login', [LoginController::class, 'postLogin'])->name('post-login');
Route::get('/register', [LoginController::class, 'getRegister'])->name('register-page');
Route::post('/register', [LoginController::class, 'postRegister'])->name('post-register');
Route::get('/profile', [PagesController::class, 'getProfile'])->name('profile-page');
Route::get('/logout', [LoginController::class, 'getLogout'])->name('logout');
Route::post('/check_login', [PagesController::class, 'check_login']);
Route::get('/loginAdmin', [LoginController::class, 'getLoginAdmin'])->name('loginAdmin');
Route::post('/loginAdmin', [LoginController::class, 'postLoginAdmin'])->name('loginAdmin');

// Router Admin
Route::middleware('admin')->group(function(){
Route::prefix('admin')->group(function () {

    Route::get('/', [PagesController::class, 'getAdminDashboard'])->name('admin-dashboard-page');

    Route::get('/getBrand', [BrandController::class, 'getBrand'])->name('admin-getBrand');
    Route::get('/showBrand', [BrandController::class, 'showBrand'])->name('admin-showBrand');
    Route::get('/addBrand', [BrandController::class, 'addBrand'])->name('admin-addBrand');
    Route::post('/addBrandHandle', [BrandController::class, 'addBrandHandle'])->name('admin-addBrand-handle');
    Route::get('brand/{id}/delete', [BrandController::class, 'destroy'])->name('admin-destroyBrand');

    // Laptop
    Route::get('/getLaptop', [LaptopController::class, 'getLaptop'])->name('admin-getLaptop');
    Route::get('/showLaptop', [LaptopController::class, 'showLaptop'])->name('admin-showLaptop');
    Route::get('/addLaptop', [LaptopController::class, 'addLaptop'])->name('admin-addLaptop');
    Route::post('/addLaptopHandle', [LaptopController::class, 'addLaptopHandle'])->name('admin-addLaptop-handle');
    // Route::get('/detailLaptop', [LaptopController::class, 'detailLaptop'])->name('admin-detailLaptop');
    Route::get('laptop/{id}/delete', [LaptopController::class, 'destroy'])->name('admin-destroyLaptop');
    Route::get('laptop/{id}/edit', [LaptopController::class, 'edit'])->name('admin-editLaptop');
    Route::put('laptop/{id}/edit', [LaptopController::class, 'update'])->name('admin-updateLaptop');

    // Payment method
    Route::get('/getPayment', [PaymentController::class, 'getPayment'])->name('admin-getPayment');
    Route::get('/showPayment', [PaymentController::class, 'showPayment'])->name('admin-showPayment');
    Route::get('/addPayment', [PaymentController::class, 'addPayment'])->name('admin-addPayment');
    Route::post('/addPaymentHandle', [PaymentController::class, 'addPaymentHandle'])->name('admin-addPayment-handle');
 });
});







