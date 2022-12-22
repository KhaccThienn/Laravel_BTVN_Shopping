<?php

namespace App\Helpers;

use App\Models\Product;

class Cart
{
    // private $item = [];
    private $items = [];

    private $totalPrice = 0;
    private $totalQty = 0;

    public function __construct()
    {
        $this->items = session('cart') ? session('cart') : [];
    }

    public function add($product, $quantity = 1)
    {
        try {
            $item = [
                'product_id' => $product->id,
                'name' => $product->name,
                'image' => $product->image,
                'price' => $product->sale_price ? $product->sale_price : $product->price,
                'quantity' => $quantity
            ];

            if (isset($this->items[$product->id])) {
                $this->items[$product->id]['quantity'] += $quantity;
            } else {
                $this->items[$product->id] = $item;
            }
            session(['cart' => $this->items]);
        } catch (\Throwable $th) {
            dd($th->getMessage());
        }
    }

    public function update($quantity, $product)
    {
        $quantity = $quantity >= 1 ? $quantity : 1;
        if ($this->items[$product->id]) {
            $this->items[$product->id]['quantity'] = $quantity;
        }
        session(['cart' => $this->items]);
    }

    public function delete($product)
    {
        if ($this->items[$product->id]) {
            unset($this->items[$product->id]);
        }
        session(['cart' => $this->items]);
    }

    public function getCart()
    {
        return $this->items;
    }

    public function getTotalPrice()
    {
        foreach($this->items as $item) {
            $this->totalPrice += $item['quantity'] * $item['price'];
        }
        return $this->totalPrice;
    }

    public function getTotalQty()
    {
        $total = 0;
        foreach($this->items as $item) {
            $total += $item['quantity'];
        }

        return $total;
    }
    public function clear()
    {
        session(['cart' => null]);
    }

}
