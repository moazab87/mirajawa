<?php

namespace App\Services\Web;

use App\Enums\FixedPageSlugEnum;
use App\Models\Address;
use App\Models\Branch;
use App\Models\Category;
use App\Models\ContactInformation;
use App\Models\Faq;
use App\Models\FixedPage;
use App\Models\History;
use App\Models\InformationBlock;
use App\Models\Product;
use App\Models\ProductGroup;
use App\Models\Profile;
use App\Models\Video;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Collection;

class WebsiteContentService
{
    public function fixedPage(string|FixedPageSlugEnum $slug): ?FixedPage
    {
        $slugValue = $slug instanceof FixedPageSlugEnum ? $slug->value : $slug;

        return FixedPage::active()->whereSlug($slugValue)->first();
    }

    public function fixedPages(array $slugs = []): Collection
    {
        $query = FixedPage::active()->orderBy('id');

        if ($slugs !== []) {
            $normalized = array_map(
                fn ($slug) => $slug instanceof FixedPageSlugEnum ? $slug->value : $slug,
                $slugs
            );
            $query->whereIn('slug', $normalized);
        }

        return $query->get();
    }

    public function sliders(): Collection
    {
        return Slider::active()
            ->with('attachments')
            ->orderBy('id')
            ->get();
    }

    public function categoriesWithCounts(): Collection
    {
        return Category::active()
            ->withCount(['products' => fn ($q) => $q->active()])
            ->orderBy('id')
            ->get();
    }

    public function categoriesWithGroups(): Collection
    {
        return Category::active()
            ->with(['productGroups' => fn ($q) => $q->active()])
            ->orderBy('id')
            ->get();
    }

    public function productGroups(?int $categoryId = null): Collection
    {
        $query = ProductGroup::active()->with('category');

        if ($categoryId) {
            $query->where('category_id', $categoryId);
        }

        return $query->orderBy('id')->get();
    }

    public function featuredProducts(int $limit = 6): Collection
    {
        return Product::active()
            ->with(['attachments', 'category', 'productGroup'])
            ->latestFirst()
            ->limit($limit)
            ->get();
    }

    public function paginateProducts(array $filters = [], int $perPage = 12): LengthAwarePaginator
    {
        $query = Product::active()
            ->with(['attachments', 'category', 'productGroup']);

        if (!empty($filters['category_id'])) {
            $query->byCategory((int) $filters['category_id']);
        }

        if (!empty($filters['product_group_id'])) {
            $query->byProductGroup((int) $filters['product_group_id']);
        }

        if (!empty($filters['search'])) {
            $search = $filters['search'];
            $query->where(function ($q) use ($search) {
                foreach (languages() as $locale) {
                    $q->orWhere("name->{$locale}", 'like', "%{$search}%");
                }
            });
        }

        return $query->latestFirst()->paginate($perPage)->withQueryString();
    }

    public function product(int $id): Product
    {
        return Product::active()
            ->with(['attachments', 'category', 'productGroup'])
            ->findOrFail($id);
    }

    public function relatedProducts(Product $product, int $limit = 4): Collection
    {
        return Product::active()
            ->where('category_id', $product->category_id)
            ->where('id', '!=', $product->id)
            ->with('attachments')
            ->latestFirst()
            ->limit($limit)
            ->get();
    }

    public function profiles(): Collection
    {
        return Profile::active()->orderBy('id')->get();
    }

    public function histories(): Collection
    {
        return History::active()->orderForTimeline()->get();
    }

    public function informationBlocks(): Collection
    {
        return InformationBlock::active()->orderBy('id')->get();
    }

    public function branches(): Collection
    {
        return Branch::active()->with('images')->orderBy('id')->get();
    }

    public function faqs(): Collection
    {
        return Faq::active()->orderBy('id')->get();
    }

    public function videos(): Collection
    {
        return Video::active()->ordered()->get();
    }

    public function addresses(): Collection
    {
        return Address::active()->orderBy('id')->get();
    }

    public function contactInformation(): Collection
    {
        return ContactInformation::active()->orderBy('id')->get();
    }
}
