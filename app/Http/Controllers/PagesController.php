<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Http\Controllers\Admin\LaptopController;
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

    public function getLogin(){
        return view('login');
    }

    public function getRegister(){
        return view('register');
    }

    public function getProfile(){
        return view('profile');
    }

    // Admin
    public function getAdminDashboard(){
        return view('Admins.dashboard');
    }
}
