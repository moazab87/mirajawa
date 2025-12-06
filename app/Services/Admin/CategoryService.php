<?php

namespace App\Services\Admin;

use App\Models\Category;
use App\Models\User;
use Illuminate\Contracts\View\View;

class CategoryService
{
    private function dropdowns(): array
    {
        $members = User::query()
            ->select('id', 'name')
            ->orderBy('name')
            ->pluck('name', 'id')
            ->toArray();

        return compact('members');
    }

    /**
     * Static page meta shared between create/edit.
     */
    private function basePageData(): array
    {
        return [
            'active'     => 'categories',
            'title'      => __('route.categories.index'),
            'singleName' => 'category',
            'route'      => route('admin.categories.index'),
        ];
    }

    /**
     * Helper to render create/edit with merged data.
     */
    private function renderForm(string $view, array $data = []): View
    {
        return view($view, array_merge(
            $this->basePageData(),
            $this->dropdowns(),
            $data
        ));
    }

    public function create(): View
    {
        return $this->renderForm('admin.categories.create', [
            'subTitle'   => __('route.categories.create'),
            'storeRoute' => route('admin.categories.store'),
        ]);
    }

    public function edit(Category $category): View
    {
        return $this->renderForm('admin.categories.edit', [
            'subTitle'    => __('route.categories.edit'),
            'updateRoute' => route('admin.categories.update', $category->id),
            // 'model'       => $category->loadMissing(['owner:id,name', 'members:id,name']),
            'model'       => $category,
        ]);
    }

    public function store(array $data): array
    {
        $category = Category::create($data);

        if ($category && isset($data['members'])) {
            $category->members()->sync($data['members']);
        }

        return ['key' => 'success', 'msg' => __('admin.successMessageText')];
    }

    public function update(Category $category, array $data): array
    {
        $updated = $category->update($data);

        if ($updated && isset($data['members'])) {
            $category->members()->sync($data['members']);
        }

        return ['key' => 'success', 'msg' => __('admin.editSuccessMessageText')];
    }
}
