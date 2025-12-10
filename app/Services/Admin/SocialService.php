<?php

namespace App\Services\Admin;

use App\Models\Social;
use Illuminate\Contracts\View\View;

class SocialService
{
    /**
     * Static page meta shared between create/edit.
     */
    private function basePageData(): array
    {
        return [
            'active'     => 'socials',
            'title'      => __('route.socials.index'),
            'singleName' => 'social',
            'route'      => route('admin.socials.index'),
        ];
    }

    /**
     * Helper to render create/edit with merged data.
     */
    private function renderForm(string $view, array $data = []): View
    {
        return view($view, array_merge(
            $this->basePageData(),
            $data
        ));
    }

    public function create(): View
    {
        return $this->renderForm('admin.socials.create', [
            'subTitle'   => __('route.socials.create'),
            'storeRoute' => route('admin.socials.store'),
        ]);
    }

    public function edit(Social $social): View
    {
        return $this->renderForm('admin.socials.edit', [
            'subTitle'    => __('route.socials.edit'),
            'updateRoute' => route('admin.socials.update', $social->id),
            'model'       => $social,
        ]);
    }

    public function store(array $data): array
    {
        // Set default order if not provided
        if (!isset($data['order'])) {
            $data['order'] = (Social::max('order') ?? 0) + 1;
        }

        Social::create($data);

        return ['key' => 'success', 'msg' => __('admin.successMessageText')];
    }

    public function update(Social $social, array $data): array
    {
        $social->update($data);

        return ['key' => 'success', 'msg' => __('admin.editSuccessMessageText')];
    }
}


