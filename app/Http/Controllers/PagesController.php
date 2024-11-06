<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Http\Controllers\Admin\BrandController;
use App\Models\Brand;

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
    
    public function getLogin(){
        return view('login');
    }
    
    public function getRegister(){
        return view('register');
    }
    

    // Admin
    public function getAdminDashboard(){
        return view('Admins.dashboard');
    }
}
