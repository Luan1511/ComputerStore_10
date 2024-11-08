<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Admin\Brand;

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

    public function addBrand()
    {
        return view('Admins.components.brands.add');
    }

    public function addBrandHandle(Request $request)
    {
        // dd($request->all());

        $request->validate([
            'name' => 'required|string|max:255',
        ]);

        $brand = new Brand([
            'name' => $request->name
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
            'name' => 'required|string|max:255'
        ]);

        $brand = Brand::findOrFail($id);

        $brand->update([
            'name' => $request->name,
        ]);

        return redirect()->back()->with('status', 'Brand Updated');
    }
}
