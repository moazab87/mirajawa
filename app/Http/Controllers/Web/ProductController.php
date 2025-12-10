<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function show($id)
    {
        $product = Product::with('attachments', 'category')->findOrFail($id);
        $relatedProducts = Product::where('category_id', $product->category_id)
            ->where('id', '!=', $product->id)
            ->with('attachments')
            ->limit(4)
            ->get();
        $fixedPages = \App\Models\FixedPage::all();

        return view('web.products.show', compact('product', 'relatedProducts', 'fixedPages'));
    }
}

