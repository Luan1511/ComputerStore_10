<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Admin\Brand;
use Illuminate\Support\Facades\File;

class BrandController extends Controller
{
    public function getBrand()
    {
        $brands = Brand::select(['id', 'name', 'image'])->get();
        return response()->json(['data' => $brands]);
    }

    public function showBrand()
    {
        $this->getBrand();
        return view('Admins.components.brands.list');
    }

    public function addBrand()
    {
        return view('Admins.components.brands.add');
    }

    public function addBrandHandle(Request $request)
    {
        // dd($request->all());

        $request->validate([
            'name' => 'required|string|max:255',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg',
        ]);

        $imagePath = '';
        if ($request->hasFile('image')) {
            if ($request->file('image')) {
                $originalFileName = $request->file('image')->getClientOriginalName();
                $imagePath = $request->file('image')->storeAs('images/brands', $originalFileName, 'public');
            }
        }

        $brand = new Brand([
            'name' => $request->name,
            'image' => $imagePath
        ]);

        $brand->save();

        return redirect()->route('admin-showBrand')->with('status', 'Brand Added');
    }

    public function destroy(int $id)
    {
        $brand = Brand::findOrFail($id);

        $brand->delete();

        return redirect()->back()->with('status', 'Brand Deleted');
    }

    public function edit(int $id)
    {
        $brand = Brand::findOrFail($id);
        return view('Admins.components.brands.edit', compact('brand'));
    }

    public function update(Request $request, int $id)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg',
        ]);

        $brand = Brand::findOrFail($id);

        if ($request->image == null) {
            $imagePath = $brand->image;
        } else {
            if ($request->hasFile('image')) {
                $originalFileName = $request->file('image')->getClientOriginalName();
                $imagePath = $request->file('image')->storeAs('images/brands', $originalFileName, 'public');

                if (File::exists($brand->image)) {
                    File::delete($brand->image);
                }
            }
        }

        $brand->update([
            'name' => $request->name,
            'image' => $imagePath,
        ]);

        return redirect()->back()->with('status', 'Brand Updated');
    }
}
