<?php

use Illuminate\Support\Facades\Route;

use App\Models\User;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\PagesController;
use App\Http\Controllers\Admin\LaptopController;
use App\Http\Controllers\Admin\BrandController;
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
Route::get('/about', [PagesController::class, 'getAbout'])->name('about-page');
Route::get('/contact', [PagesController::class, 'getContact'])->name('contact-page');
Route::get('/wishlist', [PagesController::class, 'getWishlist'])->name('wishlist-page');
Route::get('/checkout', [PagesController::class, 'getCheckout'])->name('checkout-page');
Route::get('/cart', [PagesController::class, 'getCart'])->name('cart-page');
Route::get('/login', [PagesController::class, 'getLogin'])->name('login-page');
Route::get('/register', [PagesController::class, 'getRegister'])->name('register-page');

// Router Admin
Route::prefix('/admin')->group(function () {

    Route::get('/', [PagesController::class, 'getAdminDashboard'])->name('admin-dashboard-page');

    Route::get('/getBrand', [BrandController::class, 'getBrand'])->name('admin-getBrand');
    Route::get('/showBrand', [BrandController::class, 'showBrand'])->name('admin-showBrand');
});


// Route::get('/user', function () {
//     return view('form');
// })->name('user.form');

// Route::post('/user', function () {
//     return 'Post method for user';
// });

// Route::put('/user', function () {
//     print_r(route('home'));
//     return 'Put method for user';
// });
