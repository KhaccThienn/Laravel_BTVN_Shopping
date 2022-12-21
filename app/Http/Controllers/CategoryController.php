<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Requests\Category\CategoryStoreRequest;
use App\Http\Requests\Category\CategoryUpdateRequest;

class CategoryController extends Controller
{
    public function index()
    {
        $categories = Category::search()->orderBy('id', 'desc')->paginate(3);
        return view('admin.category.index', compact('categories'));
    }

    public function show(Category $category)
    {
        $cat = $category;
        return view('admin.category.detail', compact('cat'));
    }

    public function create()
    {
        return view('admin.category.create');
    }

    public function edit(Category $category)
    {
        $cat = $category;
        return view('admin.category.edit', compact('cat'));
    }

    public function update(CategoryUpdateRequest $request, Category $category)
    {
        $form_data = $request->all('name', 'status');

        try {
            $category->update($form_data);
            return redirect()->route('category.index')->with('success', "Update Data Successfully");
        } catch (\Throwable $th) {
            return redirect()->route('category.index')->with('success', "Update Data Unsuccessfully");
        }
    }

    public function destroy(Category $category)
    {
        if ($category->products->count() > 0) {
            return redirect()->route('category.index')->with('success', 'Deletion failed, category has products');
        } else {
            try {
                $category->delete();
                return redirect()->route('category.recycle_bin')->with('success', 'Delete Successfully');
            } catch (\Throwable $th) {
                return redirect()->route('category.index')->with('success', 'Deletion failed');
            }
        }
    }

    public function recycle_bin ()
    {
        $categories = Category::onlyTrashed()->get();
        return view('admin.category.trash', compact('categories'));
    }

    public function restored($id)
    {
        Category::onlyTrashed()->find($id)->restore();
        return redirect()->route('category.index')->with('success', 'Restore Sucessfully');
    }

    public function force_delete($id)
    {
        Category::onlyTrashed()->find($id)->forceDelete();
        return redirect()->route('category.index')->with('success', 'Delete Sucessfully');
    }

    public function store(CategoryStoreRequest $request)
    {
        $form_data = $request->all('name', 'status');

        try {
            Category::create($form_data);
            return redirect()->route('category.index')->with('success', 'Insert Data Successfully');
        } catch (\Throwable $th) {
            return redirect()->route('category.index')->with('success', 'Insert Data Unsuccessfully');
        }
    }
}
