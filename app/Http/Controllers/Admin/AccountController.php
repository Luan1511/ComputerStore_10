<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Validation\ValidationException;
use Illuminate\Http\Request;
use App\Models\Admin\Account;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Log;

class AccountController extends Controller
{
    public function getAccount()
    {
        $accounts = Account::select([
            'id',
            'name',
            'email',
            'phone',
            'address',
            'authority',
            'birthday',
            'img',
        ])->get()
            ->map(function ($account) {
                if (!$account->img) {
                    $account->img_url = '';
                } else $account->img_url = $account->img;
                return $account;
            });

        return response()->json(['data' => $accounts]);
    }

    // public function showDetailAccount(int $id)
    // {
    //     $account = Account::findOrFail($id);
    //     $account->brand_name = $account->brand->name;
    //     return view('Admins.components.accounts.detail', compact('account'));
    // }

    public function showAccount()
    {
        $this->getAccount();
        return view('Admins.components.accounts.list');
    }

    // public function addAccount()
    // {
    //     return view('Admins.components.accounts.add');
    // }

    // public function addAccountHandle(Request $request)
    // {
    //     try {
    //         $request->validate([
    //             'name' => 'required|string|max:255',
    //             'brand' => 'required|integer|exists:brands,id',
    //             'processor' => 'required|string',
    //             'ram' => 'required|string',
    //             'rom' => 'required|string',
    //             'screen_size' => 'required|string',
    //             'graphics_card' => 'required|string',
    //             'battery' => 'required|string',
    //             'os' => 'required|string',
    //             'price' => 'required|numeric|min:0',
    //             'stock' => 'required|integer|min:0',
    //             'description' => 'nullable|string',
    //             'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:3074',
    //         ]);
    //     } catch (ValidationException $e) {
    //         return response()->json(['errors' => $e->errors()], 422);
    //     }

    //     if ($request->hasFile('image')) {
    //         $originalFileName = $request->file('image')->getClientOriginalName();
    //         $imagePath = $request->file('image')->storeAs('images', $originalFileName, 'public');
    //     }

    //     $account = new Account([
    //         'name' => $request->name,
    //         'brand_id' => $request->brand,
    //         'processor' => $request->processor,
    //         'ram' => $request->ram,
    //         'rom' => $request->rom,
    //         'screen_size' => $request->screen_size,
    //         'graphics_card' => $request->graphics_card,
    //         'battery' => $request->battery,
    //         'os' => $request->os,
    //         'price' => $request->price,
    //         'stock' => $request->stock,
    //         'description' => $request->description,
    //         'img' => $imagePath
    //     ]);

    //     $account->save();

    //     return redirect()->route('admin-showaccount')->with('status', 'account Added');
    // }

    public function destroy(int $id)
    {
        $account = Account::findOrFail($id);

        if ($account->img) {
            $fullPath = public_path($account->img);
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

        $account->delete();

        return redirect()->route('admin-showAccount')->with('status', 'account Deleted');
    }



    // public function edit(int $id)
    // {
    //     $account = Account::findOrFail($id);
    //     return view('Admins.components.accounts.edit', compact('account'));
    // }

    // public function update(Request $request, int $id)
    // {
    //     // dd($request->image);

    //     $request->validate([
    //         'name' => 'required|string|max:255',
    //         'brand' => 'required|integer|exists:brands,id',
    //         'processor' => 'required|string',
    //         'ram' => 'required|string',
    //         'rom' => 'required|string',
    //         'screen_size' => 'required|string',
    //         'graphics_card' => 'required|string',
    //         'battery' => 'required|string',
    //         'os' => 'required|string',
    //         'price' => 'required|numeric|min:0',
    //         'stock' => 'required|integer|min:0',
    //         'description' => 'nullable|string',
    //         'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:3074',
    //     ]);

    //     $account = Account::findOrFail($id);

    //     if ($account->image == null) {
    //         $imagePath = $account->img;
    //     } else {
    //         if ($request->hasFile('image')) {
    //             $originalFileName = $request->file('image')->getClientOriginalName();
    //             $imagePath = $request->file('image')->storeAs('images', $originalFileName, 'public');

    //             if (File::exists($account->image)) {
    //                 File::delete($account->image);
    //             }
    //         }
    //     }

    //     $account->update([
    //         'name' => $request->name,
    //         'brand_id' => $request->brand,
    //         'processor' => $request->processor,
    //         'ram' => $request->ram,
    //         'rom' => $request->rom,
    //         'screen_size' => $request->screen_size,
    //         'graphics_card' => $request->graphics_card,
    //         'battery' => $request->battery,
    //         'os' => $request->os,
    //         'price' => $request->price,
    //         'stock' => $request->stock,
    //         'description' => $request->description,
    //         'img' => $imagePath
    //     ]);

    //     return redirect()->back()->with('status', 'account Updated');
    // }
}
