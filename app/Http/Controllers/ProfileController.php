<?php

namespace App\Http\Controllers;

use App\Models\Admin\Order;
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

    public function profileView(int $id)
    {
        $user = Auth::user();
        return view('profile', compact('user'));
    }

    public function update(Request $request, int $id)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'gender' => 'required|string|max:255',
            'phone' => 'required|string|max:255',
            'address' => 'required|string|max:500',
            'birthday' => 'required|date',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:3074',
        ]);

        $user = User::findOrFail($id);

        // Xử lý hình ảnh
        if ($request->hasFile('image')) {
            $originalFileName = $request->file('image')->getClientOriginalName();
            $imagePath = $request->file('image')->storeAs('images', $originalFileName, 'public');

            // Xóa ảnh cũ nếu tồn tại
            if ($user->img && File::exists(public_path('storage/' . $user->img))) {
                File::delete(public_path('storage/' . $user->img));
            }
        } else {
            // Giữ nguyên ảnh cũ nếu không có ảnh mới
            $imagePath = $user->img;
        }

        // Cập nhật thông tin người dùng
        $user->update([
            'name' => $request->name,
            'email' => $request->email,
            'gender' => $request->gender,
            'phone' => $request->phone,
            'address' => $request->address,
            'birthday' => $request->birthday,
            'img' => $imagePath
        ]);

        // Trả về thông báo thành công
        return redirect()->route('profile-page', ['id' => $user->id])
            ->with('status', 'Customer Updated Successfully');
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

        $point = Point::findOrFail(auth()->id());
        $point->update(['point' => $point->point + (int)$purchase->total_price * 0.01]);

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
}
