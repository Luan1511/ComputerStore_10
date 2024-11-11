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

use App\Models\Admin\Laptop;

class PagesController extends Controller
{
    protected $users;
    protected $brands;
    protected $laptops;
    protected $payment;

    public function getHome(){
        $laptops = Laptop::all();
        return view('home', compact('laptops'));
    }

    public function getSingleLaptop(int $id){
        $laptop = Laptop::findOrFail($id);

        $laptop->brand_name = $laptop->brand->name;

        $images = $laptop->images()->pluck('image_url');
        $laptop->images_url = $images;

        return view('single-product', compact('laptop'));
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
