<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Helpers\Cart;
use App\Models\Order;
use App\Models\OrderDetail;
use Illuminate\Support\Facades\Auth;

class OrderController extends Controller
{
    public function checkout(Cart $cart)
    {
        $customer = Auth::user();
        return view('customers.cart.checkout', compact('cart', 'customer'));
    }

    public function post_checkout(Request $req, Cart $cart)
    {
        $data = [
            'user_id' => Auth::user()->id,
            'address' => $req->address,
            'phone' => $req->phone
        ];

        if ($order = Order::create($data)) {
            foreach ($cart->getCart() as $item) {
                $detail = [
                    'order_id' => $order->id,
                    'product_id' => $item['product_id'],
                    'price' => $item['price'],
                    'quantity' => $item['quantity'],
                ];

                OrderDetail::create($detail);
            }
            $cart->clear();

            return redirect()->route('order.success');
        }

        return redirect()->back()->with('message', 'Please Try Again');
    }
    public function history()
    {
        $customer = Auth::user();
        return view('customers.cart.order_history', compact('customer'));
    }

    public function detail(Order $order)
    {
        $customer = Auth::user();
        return view('customers.cart.order_detail', compact('order', 'customer'));
    }

    public function order_success()
    {
        return view('customers.cart.order_success');
    }
}
