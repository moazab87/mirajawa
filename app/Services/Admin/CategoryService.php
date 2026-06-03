<?php

namespace App\Services\Admin;

use App\Models\Category;
use Illuminate\Contracts\View\View;

class CategoryService extends AbstractAdminCrudService
{
    protected function modelClass(): string
    {
        return Category::class;
    }

    protected function activeKey(): string
    {
        return 'categories';
    }

    protected function routeKey(): string
    {
        return 'categories';
    }

    protected function singleName(): string
    {
        return 'category';
    }
}
