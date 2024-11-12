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
        $cartItems = Cart::where('customer_id', $user->id)->with('laptop')->get();

        $data = $cartItems->map(function ($item) {
            return [
                'id' => $item->laptop->id,
                'name' => $item->laptop->name,
                'price' => $item->laptop->price,
                'img' => $item->laptop->img,
                'quantity' => $item->quantity,
                'total_price' => $item->quantity * $item->laptop->price,
            ];
        });

        $totalPrice = $data->sum('total_price');
        return response()->json(['data' => $data,
                                'total_price' => $totalPrice]);
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
