<?php

namespace App\Services\Admin;

use App\Models\Category;
use App\Models\ProductGroup;
use Illuminate\Http\Request;

class ProductGroupService extends AbstractAdminCrudService
{
    protected function modelClass(): string
    {
        return ProductGroup::class;
    }

    protected function activeKey(): string
    {
        return 'productGroups';
    }

    protected function routeKey(): string
    {
        return 'productGroups';
    }

    protected function singleName(): string
    {
        return 'productGroup';
    }

    protected function dropdowns(): array
    {
        return ['categories' => $this->categoryOptions()];
    }

    public function indexExtraData(Request $request): array
    {
        return ['categories' => Category::orderBy('id')->get()];
    }

    private function categoryOptions(): array
    {
        return Category::query()->orderBy('id')->get()->mapWithKeys(function ($category) {
            return [$category->id => $category->getDisplayTranslation('name')];
        })->toArray();
    }
}
