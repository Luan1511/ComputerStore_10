<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Admin\Laptop;
use App\Models\Wishlist;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class WishListController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        $wishlist = Wishlist::where('customer_id', $user->id)->with('laptop')->get();
        return view('wishlist.index', compact('wishlist'));
    }

    public function getWishlist()
    {
        $user = Auth::user();
        $wishlist = Wishlist::where('customer_id', $user->id)->with('laptop')->get();
        $laptops = $wishlist->pluck('laptop');
        return response()->json(['data' => $laptops]);
    }


    public function add(Request $request)
    {
        $user = Auth::user();
        $productId = $request->input('product_id');

        $wishlistItem = Wishlist::firstOrCreate([
            'user_id' => $user->id,
            'product_id' => $productId
        ]);

        return redirect()->back()->with('success', 'Product added to wishlist');
    }

    public function remove($id)
    {
        $user = Auth::user();
        Wishlist::where('user_id', $user->id)->where('id', $id)->delete();

        return redirect()->back()->with('success', 'Product removed from wishlist');
    }
}

