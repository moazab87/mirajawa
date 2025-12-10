<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function index()
    {
        $categories = Category::withCount('products')->get();
        $fixedPages = \App\Models\FixedPage::all();

        return view('web.categories.index', compact('categories', 'fixedPages'));
    }

    public function show($id)
    {
        $category = Category::with('products.attachments', 'products.category')->findOrFail($id);
        $products = $category->products()->with('attachments', 'category')->paginate(12);
        $fixedPages = \App\Models\FixedPage::all();

        return view('web.categories.show', compact('category', 'products', 'fixedPages'));
    }
}

