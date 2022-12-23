<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;

class PagesController extends Controller
{
    public function index()
    {
        $newProducts = Product::orderBy('id', 'DESC')->limit(8)->get();
        $randomProducts = Product::inRandomOrder()->limit(4)->get();
        $saleProducts = Product::orderBy('sale_price', 'ASC')->where('sale_price', '>', 0)->limit(8)->get();
        return view('customers.index', compact('newProducts', 'randomProducts', 'saleProducts'));
    }
    public function sign_up()
    {
        return view('customers.account.signup');
    }
    public function shop()
    {
        $allProds = Product::search()->filter()->paginate(12)->withQueryString();
        return view('customers.product.index', compact('allProds'));
    }

    public function shop_cate($id)
    {
        $cate = Category::find($id);
        $allProds = $cate->products()->paginate(12)->withQueryString();
        return view('customers.product.index', compact('allProds'));
    }

    // public function detail($slug, $id)
    // {
    //     $prod = Product::find();
    //     return view('customers.product.detail', compact('prod'));
    // }

    public function detail($id, $slug)
    {
        $prod = Product::find($id);
        return view('customers.product.detail', compact('prod'));
    }
}
