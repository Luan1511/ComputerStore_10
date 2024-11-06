<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Brand;

class BrandController extends Controller
{
    public function getBrand()
    {
        $brands = Brand::select(['id', 'name'])->get();
        return response()->json(['data' => $brands]);
    }

    public function showBrand()
    {
        $this->getBrand();
        return view('Admins.components.brands.list');
    }
}
