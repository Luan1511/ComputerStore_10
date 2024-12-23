<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Admin\Laptop;
use App\Models\Cart;
use App\Models\Wishlist;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CartController extends Controller
{
    // public function index()
    // {
    //     $user = Auth::user();
    //     $cart = Cart::where('customer_id', $user->id)->with('laptop')->get();
    //     return view('wishlist.index', compact('cart'));
    // }

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
        return response()->json([
            'data' => $data,
            'total_price' => $totalPrice
        ]);
    }


    public function addSingle(int $laptop_id)
    {
        $user = Auth::user();

        if (Laptop::find($laptop_id)->stock == Cart::where('customer_id', $user->id)->where('laptop_id', $laptop_id)->pluck('quantity')->first()){
            return redirect()->back()->with('status', 'Out stock');
        }

        if ($this->checkLaptopInCart($laptop_id)) {
            $item = Cart::where('customer_id', $user->id)->where('laptop_id', $laptop_id)->first();
            $oldQty = $item->quantity;
            Cart::where('customer_id', $user->id)->where('laptop_id', $laptop_id)->update([
                'quantity' => $oldQty + 1
            ]);
            return redirect()->back()->with('status', 'plused');
        }

        Cart::firstOrCreate([
            'customer_id' => $user->id,
            'laptop_id' => $laptop_id,
            'quantity' => 1
        ]);

        return redirect()->back()->with('status', 'addedCart');
    }

    public function addByQuantity(int $laptop_id, int $qty)
    {
        if (Laptop::find($laptop_id)->stock < $qty){
            return redirect()->back()->with('status', 'Out stock');
        }

        $user = Auth::user();

        if ($this->checkLaptopInCart($laptop_id)) {
            $item = Cart::where('customer_id', $user->id)->where('laptop_id', $laptop_id)->first();
            $oldQty = $item->quantity;
            Cart::where('customer_id', $user->id)->where('laptop_id', $laptop_id)->update([
                'quantity' => $oldQty + $qty
            ]);
            return redirect()->back()->with('status', 'plused');
        }

        Cart::firstOrCreate([
            'customer_id' => $user->id,
            'laptop_id' => $laptop_id,
            'quantity' => $qty
        ]);

        return redirect()->back()->with('status', 'addedCart');
    }

    public function updateQuantity($laptop_id, $quantity)
    {
        if (Laptop::find($laptop_id)->stock < $quantity) {
            return redirect()->back()->with('status', 'Out stock');
        }

        $user = Auth::user();

        // if ($this->checkLaptopInCart($laptop_id)) {
        //     ///
        // }

        $cartItem = $user->cart->where('laptop_id', $laptop_id)->first();

        if ($cartItem) {
            if ($quantity > 0) {
                $cartItem->quantity = $quantity;
                $cartItem->save();
            } else {
                $cartItem->delete();
            }
        } else {
            if ($quantity > 0) {
                $user->cart->create([
                    'laptop_id' => $laptop_id,
                    'quantity' => $quantity,
                ]);
            }
        }

        return redirect()->back()->with('status', 'updated');
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
