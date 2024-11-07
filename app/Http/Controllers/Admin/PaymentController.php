<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Admin\Payment;

class PaymentController extends Controller
{
    //
    public function getPayment()
    {
        $payments = Payment::select(['id', 'name', 'description'])->get();
        return response()->json(['data' => $payments]);
    }

    public function showPayment()
    {
        $this->getPayment();
        return view('Admins.components.payments.list');
    }

    public function addPayment()
    {
        return view('Admins.components.payments.add');
    }

    public function addPaymentHandle(Request $request)
    {
        // dd($request->all());

        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string|max:255',
        ]);

        $brand = new Payment([
            'name' => $request->name,
            'description' => $request->description
        ]);

        $brand->save();

        return view('Admins.components.payments.list');
    }
}
