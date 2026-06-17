<?php

namespace App\Services\Admin;

use App\Models\FixedPage;
use Illuminate\Database\Eloquent\Model;
use Symfony\Component\HttpKernel\Exception\HttpException;

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
        throw new HttpException(403, __('dashboard.static_page_cannot_be_created'));
    }

    public function update(Model $model, array $data): array
    {
        $data = $this->prepareData($data, $model);

        return parent::update($model, $data);
    }

    public function delete(Model $model): array
    {
        throw new HttpException(403, __('dashboard.static_page_cannot_be_deleted'));
    }

    private function prepareData(array $data, ?FixedPage $model = null): array
    {
        unset($data['slug']);

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
