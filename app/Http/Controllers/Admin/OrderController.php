<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Admin\AdminNotification;
use App\Models\Admin\Order;
use App\Models\Cart;
use App\Models\Voucher;
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
        $totalPrice = $request->input('total');
        $cartItems = $request->input('cart');
        $paymentMethodId = $request->input('payment_method_id');

        $order = new Order();
        $order->customer_id = $user->id;
        $order->name = $name;
        $order->address = $address;
        $order->status = 1;
        $order->phone = $phone;
        $order->payment_method = $paymentMethodId;
        // $order->total_price = collect($cartItems)->sum('total_price');
        $order->total_price = $totalPrice;
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

        AdminNotification::create([
            'user_id' => $user->id,
            'type' => 'New Order',
            'content' => 'Got a new order',
            'is_read' => 0,
        ]);

        return response()->json(['success' => true]);
    }

    public function applyVoucher(Request $request)
    {
        $voucherCode = $request->input('coupon_code');

        $voucher = Voucher::where('code', $voucherCode)->where('is_used', 0)->first();

        if (!$voucher) {
            return response()->json(['success' => false, 'message' => 'Invalid or used voucher']);
        }

        $voucher->update(['is_used' => 1]);

        return response()->json([
            'success' => true,
            'discount' => $voucher->discount, 
        ]);
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

    public function getOrderNotApproved()
    {
        $orders = Order::select([
            'id',
            'name',
            'phone',
            'address',
            'status',
            'total_price',
            'created_at',
        ])->where('status', 1)->get();

        return response()->json(['data' => $orders]);
    }

    public function getOrderApproved()
    {
        $orders = Order::select([
            'id',
            'name',
            'phone',
            'address',
            'status',
            'total_price',
            'created_at',
        ])->where('status', 2)->get();

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
        Order::find($id)->delete();
        
        return redirect()->route('admin-showOrder')->with('status', true);
    }

    public function approve(int $id)
    {
        $order = Order::findOrFail($id);
        $order->update(['status' => 2]);

        return redirect()->route('admin-showOrder')->with('status', true);
    }

    public function gotOrder(int $id)
    {
        $order = Order::findOrFail($id);
        $order->update(['status' => 4]);

        $laptops = $order->subOrder()->get();
        foreach ($laptops as $laptop) {
            $laptop->update(['status' => 4]);
        }

        // return redirect()->route('admin-showOrder')->with('status', true);
    }
}
