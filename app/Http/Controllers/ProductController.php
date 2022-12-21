<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Requests\Product\ProductStoreRequest;
use App\Http\Requests\Product\ProductUpdateRequest;

class ProductController extends Controller
{
    public function index()
    {
        $products = Product::search()->orderBy('id', 'desc')->paginate(3);
        return view('admin.product.index', compact('products'));
    }

    public function create()
    {
        $categories = Category::all();
        return view('admin.product.create', compact('categories'));
    }
    public function edit($id)
    {
        $categories = Category::all();
        $prod = Product::find($id);
        return view('admin.product.edit', compact('categories', 'prod'));
    }

    public function update(ProductUpdateRequest $request, $id)
    {
        $prod = Product::find($id);
        $request->validated();
        $file_name = $prod->image;

        if ($request->has('image')) {
            $file_name = time() . $request->image->getClientOriginalName();
            unlink('uploads/' . $prod->image);
            $request->image->move(public_path('uploads'), $file_name);
        }

        Product::find($id)->update([
            'name' => $request->name,
            'price' => $request->price,
            'sale_price' => $request->sale_price,
            'image' => $file_name,
            'status' => $request->status,
            'description' => $request->description,
            'category_id' => $request->category_id
        ]);
        return redirect()->route('product.index')->with('success', 'Update Data Successfully');
    }

    public function destroy($id)
    {
        Product::find($id)->delete();
        return redirect()->route('product.index')->with('success', 'Delete Data Successfully');
    }

    public function recycle_bin()
    {
        $products = Product::onlyTrashed()->get();
        return view('admin.product.trash', compact('products'));
    }

    public function restored($id)
    {
        Product::onlyTrashed()->find($id)->restore();
        return redirect()->route('product.index')->with('success', 'Restore Sucessfully');
    }

    public function force_delete($id)
    {
        $prod = Product::onlyTrashed()->find($id);
        unlink('uploads/' . $prod->image);
        Product::onlyTrashed()->find($id)->forceDelete();
        return redirect()->route('product.index')->with('success', 'Delete Sucessfully');
    }

    public function store(ProductStoreRequest $request)
    {
        $request->validated();
        $file_name = time() . $request->image->getClientOriginalName();
        $request->image->move(public_path('uploads'), $file_name);
        Product::create([
            'name' => $request->name,
            'price' => $request->price,
            'sale_price' => $request->sale_price,
            'image' => $file_name,
            'status' => $request->status,
            'description' => $request->description,
            'category_id' => $request->category_id
        ]);
        return redirect()->route('product.index')->with('success', 'Insert Data Successfully');
    }
}
