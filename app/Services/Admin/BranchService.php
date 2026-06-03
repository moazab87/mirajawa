<?php

namespace App\Services\Admin;

use App\Models\Branch;
use App\Models\BranchImage;
use Illuminate\Database\Eloquent\Model;

class BranchService extends AbstractAdminCrudService
{
    protected function modelClass(): string
    {
        return Branch::class;
    }

    protected function activeKey(): string
    {
        return 'branches';
    }

    protected function routeKey(): string
    {
        return 'branches';
    }

    protected function singleName(): string
    {
        return 'branch';
    }

    public function edit(Model $model): \Illuminate\Contracts\View\View
    {
        return parent::edit($model->load('images'));
    }

    public function store(array $data): array
    {
        $images = $data['images'] ?? [];
        unset($data['images']);

        $branch = Branch::create($data);
        $this->saveImages($branch, $images);

        return ['key' => 'success', 'msg' => __('dashboard.branches.created_successfully')];
    }

    public function update(Model $model, array $data): array
    {
        $images = $data['images'] ?? [];
        unset($data['images']);

        $model->update($data);
        $this->saveImages($model, $images);

        return ['key' => 'success', 'msg' => __('dashboard.branches.updated_successfully')];
    }

    public function deleteImage(BranchImage $image): array
    {
        deleteImage(public_path('uploads/' . BranchImage::IMAGEPATH . '/' . $image->image));
        $image->delete();

        return ['key' => 'success', 'msg' => __('dashboard.branches.deleted_successfully')];
    }

    private function saveImages(Branch $branch, array $images): void
    {
        foreach ($images as $file) {
            if ($file && is_file($file)) {
                $branch->images()->create([
                    'image' => uploadImage(BranchImage::IMAGEPATH, $file),
                ]);
            }
        }
    }
}
