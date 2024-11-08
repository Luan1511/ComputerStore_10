<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Validation\ValidationException;
use Illuminate\Http\Request;
use App\Models\Admin\Laptop;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Log;

class LaptopController extends Controller
{
    public function getLaptop()
    {
        $laptops = Laptop::with('brand:id,name')
            ->select([
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
            ])->get()
            ->map(function ($laptop) {
                $laptop->brand_name = $laptop->brand->name;
                $laptop->img_url = asset('storage/' . $laptop->img);
                unset($laptop->brand);
                return $laptop;
            });

        return response()->json(['data' => $laptops]);
    }

    public function showDetailLaptop(int $id)
    {
        $laptop = Laptop::findOrFail($id);
        $laptop->brand_name = $laptop->brand->name;
        return view('Admins.components.laptops.detail', compact('laptop'));
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

        return redirect()->route('admin-showLaptop')->with('status', 'Laptop Added');
    }

    public function destroy(int $id)
    {
        $laptop = Laptop::findOrFail($id);

        if ($laptop->img) {
            $fullPath = public_path('storage/' . $laptop->img);
            if (File::exists($fullPath)) {
                try {
                    File::delete($fullPath);
                } catch (\Exception $e) {
                    Log::error('Failed to delete image: ' . $e->getMessage());
                }
            } else {
                Log::warning('Image file not found: ' . $fullPath);
            }
        }

        $laptop->delete();

        return redirect()->back()->with('status', 'Laptop Deleted');
    }



    public function edit(int $id)
    {
        $laptop = Laptop::findOrFail($id);
        return view('Admins.components.laptops.edit', compact('laptop'));
    }

    public function update(Request $request, int $id)
    {
        // dd($request->image);

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
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:3074',
        ]);

        $laptop = Laptop::findOrFail($id);

        if ($laptop->image == null) {
            $imagePath = $laptop->img;
        } else {
            if ($request->hasFile('image')) {
                $originalFileName = $request->file('image')->getClientOriginalName();
                $imagePath = $request->file('image')->storeAs('images', $originalFileName, 'public');

                if (File::exists($laptop->image)) {
                    File::delete($laptop->image);
                }
            }
        }

        $laptop->update([
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

        return redirect()->back()->with('status', 'Laptop Updated');
    }
}
