<?php

namespace App\Http\Controllers;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Auth;

class ProfileController extends Controller
{
    public function getProfile(){
        return view('profile');
    }

    public function edit(int $id)
    {
        // Lấy thông tin người dùng từ database
        $user = Auth::user(); // Lấy thông tin người dùng đã đăng nhập
        return view('profile', compact('user')); // Truyền biến $user vào view
        // Trả về view và truyền biến $user vào view

    }

    public function update(Request $request, int $id)
    {
        // Kiểm tra dữ liệu đầu vào (validation)
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
}