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


    public function add(int $laptop_id)
    {
        $user = Auth::user();

        if ($this->checkLaptopInWishlist($laptop_id)){
            return redirect()->back()->with('status', 'existed');
        }

        $wishlistItem = Wishlist::firstOrCreate([
            'customer_id' => $user->id,
            'laptop_id' => $laptop_id
        ]);

        return redirect()->back()->with('status', 'added');
    }

    public function remove(int $laptop_id)
    {
        $user = Auth::user();
        Wishlist::where('customer_id', $user->id)->where('laptop_id', $laptop_id)->delete();

        return redirect()->back()->with('success', 'Product removed from wishlist');
    }

    public function checkLaptopInWishlist(int $laptop_id)
    {
        $user = Auth::user();  

        $exists = Wishlist::where('customer_id', $user->id)
            ->where('laptop_id', $laptop_id)
            ->exists();

        return $exists;
    }
}
