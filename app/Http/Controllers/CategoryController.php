<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Category;
use Illuminate\Support\Facades\Redirect;

class CategoryController extends Controller
{
    public function create_category()
    {
        return view('create_category');
    }
    public function store_category(Request $request)
    {
        $request->validate([
            'nama_kategori' => 'required',
        ]);
        category::create([
            'nama_kategori' => $request->nama_kategori,
        ]);

        return Redirect::route('show_category');
    }

    public function show_category(Category $category)
    {
        $categories = Category::all();
        return view('show_category', compact('categories'));
    }

    public function edit_category(category $category)
    {
        return view('edit_category', compact('category'));
    }

    public function update_category(Category $category, Request $request)
    {
        $request->validate([
            'nama_kategori' => 'required',

        ]);

        $category->update([
            'nama_kategori' => $request->nama_kategori,

        ]);

        return Redirect::route('show_category', $category);
    }

    public function delete_category(Category $category)
    {
        $category->delete();
        return Redirect::route('show_category');
    }
}
