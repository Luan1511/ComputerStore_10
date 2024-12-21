<?php

namespace App\Http\Controllers;

use App\Models\Admin\Order;
use App\Models\LicenseComment;
use App\Models\Point;
use App\Models\User;
use App\Models\Voucher;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Auth;

class ProfileController extends Controller
{
    public function getProfile()
    {
        return view('profile');
    }

    public function profileView()
    {
        $user = Auth::user();
        return view('profile', compact('user'));
    }

    public function update(Request $request, int $id)
    {
        // dd($request->all());
        $request->validate([
            'name' => 'nullable|string|max:255',
            'email' => 'nullable|email|max:255',
            'gender' => 'nullable|string|max:255',
            'phone' => 'nullable|string|max:255',
            'address' => 'nullable|string|max:526',
            'birthday' => 'nullable|date',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg',
        ]);

        $user = User::findOrFail($id);

        if ($request->hasFile('image')) {
            $originalFileName = $request->file('image')->getClientOriginalName();
            $imagePath = $request->file('image')->storeAs('images/User', $originalFileName, 'public');

            if ($user->img && File::exists(public_path('storage/' . $user->img))) {
                File::delete(public_path('storage/' . $user->img));
            }
        } else {
            $imagePath = $user->img;
        }

        $updateData = [];
        if ($request->name) {
            $updateData['name'] = $request->name;
        }
        if ($request->email) {
            $updateData['email'] = $request->email;
        }
        if ($request->gender) {
            $updateData['gender'] = $request->gender;
        }
        if ($request->phone) {
            $updateData['phone'] = $request->phone;
        }
        if ($request->address) {
            $updateData['address'] = $request->address;
        }
        if ($request->birthday) {
            $updateData['birthday'] = $request->birthday;
        }
        if (isset($imagePath)) { 
            $updateData['img'] = $imagePath;
        }
        $user->update($updateData);

        return redirect()->route('profile-page', ['id' => $user->id])
            ->with('status', 'Updated');
    }

    public function purchaseView()
    {
        $purchases = Order::where('customer_id', auth()->id())
            ->where('status', 1)
            ->with('subOrder.laptop')->get();

        return view('users.purchase', compact('purchases'));
    }

    public function purchaseMaking()
    {
        $purchases = Order::where('customer_id', auth()->id())
            ->where('status', 1)
            ->with('subOrder.laptop')->get();

        return view('users.render-purchase', compact('purchases'));
    }

    public function purchaseDelivering()
    {
        $purchases = Order::where('customer_id', auth()->id())
            ->where('status', 2)
            ->with('subOrder.laptop')->get();

        return view('users.render-purchase', compact('purchases'));
    }

    public function purchaseCompleted()
    {
        $purchases = Order::where('customer_id', auth()->id())
            ->where('status', 4)
            ->with('subOrder.laptop')->get();

        return view('users.render-purchase', compact('purchases'));
    }

    public function purchaseDenied()
    {
        $purchases = Order::where('customer_id', auth()->id())
            ->where('status', 3)
            ->with('subOrder.laptop')->get();

        return view('users.render-purchase', compact('purchases'));
    }

    public function purchaseReceived($id)
    {
        $purchase = Order::findOrFail($id);
        $purchase->update(['status' => 4]);

        $point = Point::where('user_id', auth()->id())->first();
        $point->update(['point' => $point->point + (int)($purchase->total_price * 0.1)]);

        $subOrders = $purchase->subOrder;
        foreach ($subOrders as $subOrder) {
            $license = LicenseComment::where('user_id', auth()->id())->where('laptop_id', $subOrder->laptop->id)->get();
            if ($license->count() < 1) {
                LicenseComment::create([
                    'user_id' => auth()->id(),
                    'laptop_id' => $subOrder->laptop->id,
                ]);
            }
        }

        return redirect()->back()
            ->with('status', 'Received Successfully');
    }

    public function createVoucher($discount)
    {
        $code = bin2hex(random_bytes(10 / 2));
        Voucher::create([
            'code' => $code,
            'user_id' => auth()->id(),
            'discount' => $discount,
            'is_used' => 0,
            'expiration_date' => now()->modify('+30 days'),
        ]);

        $point = Point::where('user_id', auth()->id())->first();
        $point->update(['point' => $point->point - $discount * 100]);

        return redirect()->back()->with(
            [
                'status' => 'Created Successfully',
                'code' => $code
            ]
        );
    }

    public function voucherView()
    {
        $vouchers = Voucher::where('user_id', auth()->id())
            ->where('is_used', 0)->get();

        return view('users.voucher', compact('vouchers'));
    }
}
