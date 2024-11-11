<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Notification;
use App\Http\Controllers\Admin\BrandController;
use App\Models\Admin\Account;
use App\Models\User;
use Illuminate\Support\Facades\Hash;  
use App\Models\Admin\Laptop;
use App\Models\Admin\Brand;
use App\Models\Wishlist;

class PagesController extends Controller
{
    protected $users;
    protected $brands;
    protected $laptops;
    protected $payment;

    public function getHome(){
        $laptops = Laptop::all();
        $countWishlist = Auth::user()->wishlist->count();
        return view('home', compact('laptops', 'countWishlist'));
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

    public function getWishlist(int $id){
        $customer = User::find($id);
        $wishlist = $customer->wishlist;
        return view(('wishlist'), compact('wishlist'));
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
        $userCount = User::where('authority', 2)->count();
        $laptopCount = Laptop::count();
        $brandCount = Brand::count();

        return view(('Admins.dashboard'), compact('userCount', 'laptopCount', 'brandCount'));
    }

}
