<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Notification;
use App\Http\Controllers\Admin\BrandController;
use App\Http\Controllers\Admin\LaptopController;
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
        $laptopController = new LaptopController();
        $newLaptops = $laptopController->getNewLaptop();
        $bestSellerLaptops = $laptopController->getBestSellerLaptop();

        return view('home', compact('laptops', 'newLaptops', 'bestSellerLaptops'));
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

    // Search in product page
    public function searchInPage(Request $request)
    {
        $searchBrand = $request->query('search_brand', []);
        $searchPriceSort = $request->query('search_price_sort');
        $searchScreenSize = $request->query('search_screen_size', []);
        $searchStock = $request->query('search_stock');
        $searchQuery = $request->query('search');

        $laptops = Laptop::when($searchQuery, function ($queryBuilder) use ($searchQuery) {
            return $queryBuilder->where(function ($query) use ($searchQuery) {
                $query->where('name', 'like', '%' . $searchQuery . '%')
                    ->orWhere('description', 'like', '%' . $searchQuery . '%')
                    ->orWhere('os', 'like', '%' . $searchQuery . '%')
                    ->orWhere('type', 'like', '%' . $searchQuery . '%');
            });
        })
            ->when(!empty($searchBrand), function ($queryBuilder) use ($searchBrand) {
                return $queryBuilder->whereIn('brand_id', $searchBrand);
            })
            ->when(!empty($searchScreenSize), function ($queryBuilder) use ($searchScreenSize) {
                return $queryBuilder->whereIn('screen_size', $searchScreenSize);
            })
            ->when($searchStock, function ($queryBuilder) use ($searchStock) {
                if ($searchStock[0] == 'in') {
                    return $queryBuilder->where('stock', '>=', 1);
                } else {
                    return $queryBuilder->where('stock', '<', 1);
                }
            })
            ->when($searchPriceSort, function ($queryBuilder) use ($searchPriceSort) {
                if ($searchPriceSort[0] == 'increa') {
                    return $queryBuilder->orderBy('price', 'asc');
                } else {
                    return $queryBuilder->orderBy('price', 'desc');
                }
            })
            ->get()
            ->map(function ($laptop) {
                $laptop->brand_name = $laptop->brand->name;
                return $laptop;
            });

        $brands = Brand::all();

        return view('components.laptop-list-page', compact('laptops', 'brands'));
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

    public function getProductPage()
    {
        $laptops = Laptop::get()->map(function ($laptop) {
            $laptop->brand_name = $laptop->brand->name;
            return $laptop;
        });
        $brands = Brand::all();
        return view('product-page', compact('laptops', 'brands'));
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

    // Search in search bar
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
