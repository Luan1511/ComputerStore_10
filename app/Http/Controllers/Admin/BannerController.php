<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Admin\Banner;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class BannerController extends Controller
{
    public function getAdsBanner()
    {
        $adsBanner = Banner::where('type', 'advertiser')->get();
        return response()->json(['data' => $adsBanner]);
    }

    public function showBanner()
    {
        $leftBanners = Banner::where('type', 'left')->get();
        $topBanner = Banner::where('type', 'top')->first();
        $bottomBanner = Banner::where('type', 'bottom')->first();
        return view('Admins.components.banner.banner', compact('leftBanners', 'topBanner', 'bottomBanner'));
    }

    public function updateBanners(Request $request)
    {
        // dd($request->all());
        $request->validate([
            'image_left' => 'nullable|image|mimes:jpeg,png,jpg,gif',
            'image_top' => 'nullable|image|mimes:jpeg,png,jpg,gif',
            'image_bottom' => 'nullable|image|mimes:jpeg,png,jpg,gif',
        ]);

        $leftBanner = Banner::where('type', 'left')->first();
        $topBanner = Banner::where('type', 'top')->first();
        $bottomBanner = Banner::where('type', 'bottom')->first();

        if ($request->image_left != null) {
            $originalFileName = $request->file('image_left')->getClientOriginalName();
            Banner::create([
                'type' => 'left',
                'image' => $request->file('image_left')->storeAs('images/banners', $originalFileName, 'public')
            ]);
        }

        if ($request->image_top != null) {
            if ($topBanner == null) {
                $originalFileName = $request->file('image_top')->getClientOriginalName();
                Banner::create([
                    'type' => 'top',
                    'image' => $request->file('image_top')->storeAs('images/banners', $originalFileName, 'public')
                ]);
            } else {
                if ($request->image_top == null) {
                    $imagePathTop = $topBanner->image;
                } else {
                    if ($request->hasFile('image_top')) {
                        $originalFileName = $request->file('image_top')->getClientOriginalName();
                        $imagePathTop = $request->file('image_top')->storeAs('images/banners', $originalFileName, 'public');

                        if (File::exists($topBanner->image)) {
                            File::delete($topBanner->image);
                        }
                    }
                }
                $topBanner->update([
                    'type' => 'top',
                    'image' => $imagePathTop,
                ]);
            }
        }

        if ($request->image_bottom) {
            if ($bottomBanner == null) {
                $originalFileName = $request->file('image_bottom')->getClientOriginalName();
                Banner::create([
                    'type' => 'bottom',
                    'image' => $request->file('image_bottom')->storeAs('images/banners', $originalFileName, 'public')
                ]);
            } else {
                if ($request->image_bottom == null) {
                    $imagePathBottom = $bottomBanner->image;
                } else {
                    if ($request->hasFile('image_bottom')) {
                        $originalFileName = $request->file('image_bottom')->getClientOriginalName();
                        $imagePathBottom = $request->file('image_bottom')->storeAs('images/banners', $originalFileName, 'public');

                        if (File::exists($bottomBanner->image)) {
                            File::delete($bottomBanner->image);
                        }
                    }
                }
                $bottomBanner->update([
                    'type' => 'bottom',
                    'image' => $imagePathBottom,
                ]);
            }
        }

        return response()->json([
            'success' => true,
            'message' => 'Images uploaded successfully!',
        ]);
    }

    public function destroy($id)
    {
        Banner::findOrFail($id)->delete();

        return redirect()->back()->with('status', 'Deleted');
    }
}
