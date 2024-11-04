<?php

use Illuminate\Support\Facades\Route;

use App\Models\User;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\PagesController;
use App\Http\Controllers\LaptopController;
use App\Http\Controllers\BrandController;
use App\Http\Controllers\CustomerController;
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

Route::get('/', [PagesController::class, 'gethome'])->name('homepage');
Route::get('/about', [PagesController::class, 'getabout'])->name('aboutpage');
Route::get('/contact', [PagesController::class, 'getcontact'])->name('contactpage');

// Route::get('/indexhome', 'App\Http\Controllers\HomeController@index')->name('home');
// Route::get('/home/{id}', [HomeController::class, 'gethome']);


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


