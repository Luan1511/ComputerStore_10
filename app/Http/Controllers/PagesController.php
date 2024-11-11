<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Notification;
use App\Http\Controllers\Admin\BrandController;
use App\Models\Brand;
use App\Models\User;  // Để sử dụng model User
use Illuminate\Support\Facades\Hash;  // Để sử dụng Hash::make

class PagesController extends Controller
{
    protected $users;
    protected $brands;
    protected $laptops;
    protected $payment;

    public function getHome(){
        return view('home');
    }

    public function getAbout(){
        return view('about');
    }

    public function getContact(){
        return view('contact');
    }

    public function getWishlist(){
        return view('wishlist');
    }

    public function getCheckout(){
        return view('checkout');
    }

    public function getCart(){
        return view('cart');
    }

   
    public function getProfile(){
        return view('profile');
    }

    // Admin
    public function getAdminDashboard(){
        return view('Admins.dashboard');
    }


}
