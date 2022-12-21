<?php

namespace App\Http\Controllers;

use App\Helpers\Cart;
use App\Models\Product;
use Illuminate\Http\Request;
use App\Http\Requests\Product\AddToCartRequest;
use App\Http\Requests\Product\UpdateCartRequest;

class CartController extends Controller
{
    public function add_to_cart(AddToCartRequest $request, $id)
    {
        $product = Product::find($id);
        $cart = new Cart();
        $cart->add($product, $request->quantity);
        return redirect()->route('shop.show_cart');
    }

    public function show(Cart $cart)
    {
        $carts = $cart->getCart();
        $totalPrice = $cart->getTotalPrice();
        return view('customers.product.cart', compact('carts', 'totalPrice'));
    }

    public function update_cart(UpdateCartRequest $req, Cart $cart, $id)
    {
        $product = Product::find($id);
        $cart->update($req->quantity, $product);
        return redirect()->route('shop.show_cart');
    }

    public function delete(Cart $cart, $id)
    {
        $product = Product::find($id);
        $cart->delete($product);
        return redirect()->route('shop.show_cart');
    }
}
