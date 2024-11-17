<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Notification;
use App\Http\Controllers\Admin\BrandController;
use App\Http\Controllers\CartController;
use App\Models\Admin\Account;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use App\Models\Admin\Laptop;
use App\Models\Admin\Brand;
use App\Models\Admin\Payment;
use App\Models\Wishlist;

class PagesController extends Controller
{
    protected $users;
    protected $brands;
    protected $laptops;
    protected $payment;

    public function getHome()
    {
        $laptops = Laptop::all();
        return view('home', compact('laptops'));
    }

    public function getSingleLaptop(int $id)
    {
        $laptop = Laptop::findOrFail($id);
        $laptop->brand_name = $laptop->brand->name;
        $images = $laptop->images()->pluck('image_url');
        $laptop->images_url = $images;

        $laptops = Laptop::where('brand_id', $laptop->brand_id)
            ->where('id', '!=', $laptop->id)->get();

        return view('single-product', compact('laptop', 'laptops'));
    }

    public function getLaptopByName($name)
    {
        $laptop = Laptop::where('name', $name)->firstOrFail();

        $laptop->brand_name = $laptop->brand->name;

        $images = $laptop->images()->pluck('image_url');
        $laptop->images_url = $images;

        return view('single-product', compact('laptop'));
    }

    public function getAbout()
    {
        return view('about');
    }

    public function getDetailLaptop(int $id)
    {
        $laptop = Laptop::where('id', $id)->First();
        // $laptop->brand_name = $laptop->brand->name;
        unset($laptop->desciption);
        return response()->json($laptop);
    }

    public function getContact()
    {
        return view('contact');
    }

    public function getWishlist(int $id)
    {
        $customer = User::find($id);
        $wishlist = $customer->wishlist;
        return view(('wishlist'), compact('wishlist'));
    }

    public function getCheckout()
    {
        $cartController = new CartController();
        $cartResponse = $cartController->getCart();
        $cart = json_decode($cartResponse->getContent());
        $payments = Payment::all();
        return view('checkout', compact('payments', 'cart'));
    }

    public function getCart()
    {
        return view('cart');
    }

    public function getProfile()
    {
        return view('profile');
    }

    public function search(Request $request)
    {
        $search = $request->input('search');

        $results = Laptop::where('name', 'LIKE', '%' . $search . '%')
            ->select('name')
            ->get();

        return response()->json($results);
    }

    // Admin
    public function getAdminDashboard()
    {
        $userCount = User::where('authority', 2)->count();
        $laptopCount = Laptop::count();
        $brandCount = Brand::count();

        return view(('Admins.dashboard'), compact('userCount', 'laptopCount', 'brandCount'));
    }
}
