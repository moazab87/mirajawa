<?php

namespace App\Http\Controllers\Web;

use App\Enums\FixedPageSlugEnum;
use App\Http\Controllers\Controller;
use App\Services\Web\WebsiteContentService;
use Illuminate\Http\Request;
use Illuminate\View\View;

class ProductController extends Controller
{
    public function __construct(protected WebsiteContentService $content)
    {
    }

    public function index(Request $request): View
    {
        $categoryId = $request->filled('category') ? (int) $request->input('category') : null;
        $productGroupId = $request->filled('group') ? (int) $request->input('group') : null;

        return view('web.products.index', [
            'page' => $this->content->fixedPage(FixedPageSlugEnum::PRODUCTS),
            'categories' => $this->content->categoriesWithGroups(),
            'productGroups' => $this->content->productGroups($categoryId),
            'products' => $this->content->paginateProducts([
                'category_id' => $categoryId,
                'product_group_id' => $productGroupId,
                'search' => $request->string('search')->toString() ?: null,
            ]),
            'activeCategoryId' => $categoryId,
            'activeGroupId' => $productGroupId,
            'search' => $request->string('search')->toString(),
        ]);
    }

    public function show(int $id): View
    {
        $product = $this->content->product($id);

        return view('web.products.show', [
            'product' => $product,
            'relatedProducts' => $this->content->relatedProducts($product),
        ]);
    }
}
