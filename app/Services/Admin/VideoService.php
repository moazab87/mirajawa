<?php

namespace App\Services\Admin;

use App\Models\Video;
use Illuminate\Database\Eloquent\Model;

class VideoService extends AbstractAdminCrudService
{
    protected function modelClass(): string
    {
        return Video::class;
    }

    protected function activeKey(): string
    {
        return 'videos';
    }

    protected function routeKey(): string
    {
        return 'videos';
    }

    protected function singleName(): string
    {
        return 'video';
    }

    public function store(array $data): array
    {
        $data = $this->prepareData($data);

        return parent::store($data);
    }

    public function update(Model $model, array $data): array
    {
        $data = $this->prepareData($data, $model);

        return parent::update($model, $data);
    }

    public function delete(Model $model): array
    {
        $this->deleteVideoFile($model);

        return parent::delete($model);
    }

    private function prepareData(array $data, ?Video $model = null): array
    {
        if (isset($data['video']) && is_object($data['video']) && method_exists($data['video'], 'isValid') && $data['video']->isValid()) {
            if ($model?->video) {
                $this->deleteVideoFile($model);
            }
            $data['video'] = uploadFile(Video::VIDEO_PATH, $data['video']);
        } else {
            unset($data['video']);
        }

        $data['sort_order'] = $data['sort_order'] ?? 0;

        return $data;
    }

    private function deleteVideoFile(Video $model): void
    {
        if ($model->video) {
            deleteImage(public_path('uploads/videos/' . $model->video));
        }
    }
}
