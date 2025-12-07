<?php

namespace App\Services\Admin;

use App\Models\FixedPage;
use App\Models\User;
use Illuminate\Contracts\View\View;

class FixedPageService
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
            'active'     => 'fixedPages',
            'title'      => __('route.fixedPages.index'),
            'singleName' => 'fixedPage',
            'route'      => route('admin.fixedPages.index'),
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
        return $this->renderForm('admin.fixedPages.create', [
            'subTitle'   => __('route.fixedPages.create'),
            'storeRoute' => route('admin.fixedPages.store'),
        ]);
    }

    public function edit(FixedPage $fixedPage): View
    {
        return $this->renderForm('admin.fixedPages.edit', [
            'subTitle'    => __('route.fixedPages.edit'),
            'updateRoute' => route('admin.fixedPages.update', $fixedPage->id),
            'model'       => $fixedPage,
        ]);
    }

    public function store(array $data): array
    {
        FixedPage::create($data);
        return ['key' => 'success', 'msg' => __('admin.successMessageText')];
    }

    public function update(FixedPage $fixedPage, array $data): array
    {
        $fixedPage->update($data);
        return ['key' => 'success', 'msg' => __('admin.editSuccessMessageText')];
    }
}
