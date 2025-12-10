<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\FixedPage;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        $fixedPages = FixedPage::all();
        $categories = Category::withCount('products')->get();
        $sliders = \App\Models\Slider::where('is_active', true)
            ->with('attachments')
            ->get();

        return view('web.home', compact('fixedPages', 'categories', 'sliders'));
    }
}

