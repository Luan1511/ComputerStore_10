<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Admin\Laptop;
use App\Models\Cart;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CartController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        $wishlist = Cart::where('customer_id', $user->id)->with('laptop')->get();
        return view('wishlist.index', compact('wishlist'));
    }

    public function getCart()
    {
        $user = Auth::user();
        $cart = Cart::where('customer_id', $user->id)->with('laptop')->get();
        $laptops = $cart->pluck('laptop');
        return response()->json(['data' => $laptops]);
    }


    public function addSingle(int $laptop_id)
    {
        $user = Auth::user();

        if ($this->checkLaptopInCart($laptop_id)){
            return redirect()->back()->with('status', 'existed');
        }

        $wishlistItem = Cart::firstOrCreate([
            'customer_id' => $user->id,
            'laptop_id' => $laptop_id,
            'quantity' => 1
        ]);

        return redirect()->back()->with('status', 'addedCart');
    }

    public function remove(int $laptop_id)
    {
        $user = Auth::user();
        Cart::where('customer_id', $user->id)->where('laptop_id', $laptop_id)->delete();

        return redirect()->back()->with('success', 'Laptop removed from cart');
    }

    public function checkLaptopInCart(int $laptop_id)
    {
        $user = Auth::user();  

        $exists = Cart::where('customer_id', $user->id)
            ->where('laptop_id', $laptop_id)
            ->exists();

        return $exists;
    }
}
