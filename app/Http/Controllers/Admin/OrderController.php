<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Admin\Order;
use App\Models\Cart;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class OrderController extends Controller
{
    public function placeOrder(Request $request)
    {
        $user = Auth::user();
        $name = $request->input('name');
        $address = $request->input('address');
        // $email = $request->input('email');
        $phone = $request->input('phone');
        $cartItems = $request->input('cart');
        $paymentMethodId = $request->input('payment_method_id');

        $order = new Order();
        $order->customer_id = $user->id;
        $order->name = $name;
        $order->address = $address;
        $order->status = 1;
        $order->phone = $phone;
        $order->payment_method = $paymentMethodId;
        $order->total_price = collect($cartItems)->sum('total_price');
        $order->created_at = now();
        $order->save();

        foreach ($cartItems as $item) {
            $order->subOrder()->create([
                'laptop_id' => $item['id'],
                'quantity' => $item['quantity'],
                'laptop_price' => $item['price'],
                'total_laptop_price' => $item['quantity'] * $item['price']
            ]);
        }

        Cart::where('customer_id', $user->id)->delete();

        return response()->json(['success' => true]);
    }

    public function getOrder()
    {
        $orders = Order::select([
            'id',
            'name',
            'phone',
            'address',
            'status',
            'total_price',
            'created_at',
        ])->get();

        return response()->json(['data' => $orders]);
    }

    public function showOrder()
    {
        $this->getOrder();
        return view('Admins.components.orders.list');
    }

    public function detail(int $id)
    {
        $order = Order::with(['subOrder.laptop'])->findOrFail($id);

        return view('Admins.components.orders.detail', compact('order'));
    }

    public function deny(int $id)
    {
        $order = Order::findOrFail($id);
        $order->update(['status' => 3]);
        return redirect()->route('admin-showOrder')->with('status', true);
    }

    public function delete(int $id)
    {
        $order = Order::findOrFail($id);
        $order->delete();
        return redirect()->route('admin-showOrder')->with('status', true);
    }

    public function approve(int $id)
    {
        $order = Order::findOrFail($id);
        $order->update(['status' => 2]);
        return redirect()->route('admin-showOrder')->with('status', true);
    }
}
