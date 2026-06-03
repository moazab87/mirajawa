<?php

namespace App\Services\Admin;

use App\Models\FixedPage;
use Illuminate\Database\Eloquent\Model;

class FixedPageService extends AbstractAdminCrudService
{
    protected function modelClass(): string
    {
        return FixedPage::class;
    }

    protected function activeKey(): string
    {
        return 'fixedPages';
    }

    protected function routeKey(): string
    {
        return 'fixedPages';
    }

    protected function singleName(): string
    {
        return 'fixedPage';
    }

    public function store(array $data): array
    {
        $data = $this->prepareData($data);
        FixedPage::create($data);

        return ['key' => 'success', 'msg' => __('dashboard.static_pages.created_successfully')];
    }

    public function update(Model $model, array $data): array
    {
        $data = $this->prepareData($data, $model);

        return parent::update($model, $data);
    }

    private function prepareData(array $data, ?FixedPage $model = null): array
    {
        if (empty($data['slug'])) {
            $data['slug'] = FixedPage::generateSlug($data['name'] ?? []);
        }

        if (isset($data['image']) && is_file($data['image'])) {
            if ($model?->image) {
                deleteImage(public_path('uploads/fixedPages/' . $model->image));
            }
            $data['image'] = uploadImage(FixedPage::IMAGEPATH, $data['image']);
        } else {
            unset($data['image']);
        }

        return $data;
    }
}
