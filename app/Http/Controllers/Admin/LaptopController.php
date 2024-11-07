<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Validation\ValidationException;
use Illuminate\Http\Request;
use App\Models\Admin\Laptop;

class LaptopController extends Controller
{
    public function getLaptop()
    {
        $laptops = Laptop::select([
            'id',
            'name',
            'brand_id',
            'processor',
            'ram',
            'rom',
            'screen_size',
            'graphics_card',
            'battery',
            'os',
            'price',
            'stock',
            'description',
            'created_at',
            'updated_at',
            'img',
            'rating'
        ])->get();
        return response()->json(['data' => $laptops]);
    }

    public function showLaptop()
    {
        $this->getLaptop();
        return view('Admins.components.laptops.list');
    }

    public function addLaptop()
    {
        return view('Admins.components.laptops.add');
    }

    public function addLaptopHandle(Request $request)
    {
        try {
            $request->validate([
                'name' => 'required|string|max:255',
                'brand' => 'required|integer|exists:brands,id',
                'processor' => 'required|string',
                'ram' => 'required|string',
                'rom' => 'required|string',
                'screen_size' => 'required|string',
                'graphics_card' => 'required|string',
                'battery' => 'required|string',
                'os' => 'required|string',
                'price' => 'required|numeric|min:0',
                'stock' => 'required|integer|min:0',
                'description' => 'nullable|string',
                'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:3074',
            ]);
        } catch (ValidationException $e) {
            return response()->json(['errors' => $e->errors()], 422);
        }

        if ($request->hasFile('image')) {
            $originalFileName = $request->file('image')->getClientOriginalName();
            $imagePath = $request->file('image')->storeAs('images', $originalFileName, 'public');
        }

        $laptop = new Laptop([
            'name' => $request->name,
            'brand_id' => $request->brand,
            'processor' => $request->processor,
            'ram' => $request->ram,
            'rom' => $request->rom,
            'screen_size' => $request->screen_size,
            'graphics_card' => $request->graphics_card,
            'battery' => $request->battery,
            'os' => $request->os,
            'price' => $request->price,
            'stock' => $request->stock,
            'description' => $request->description,
            'img' => $imagePath
        ]);

        $laptop->save();

        return view('Admins.components.laptops.list');
    }
}
