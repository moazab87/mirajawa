<?php

namespace App\Services\Admin;

use App\Models\Attachment;
use App\Models\Slider;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;

class SliderService extends AbstractAdminCrudService
{
    protected function modelClass(): string
    {
        return Slider::class;
    }

    protected function activeKey(): string
    {
        return 'sliders';
    }

    protected function routeKey(): string
    {
        return 'sliders';
    }

    protected function singleName(): string
    {
        return 'slider';
    }

    public function edit(Model $model): \Illuminate\Contracts\View\View
    {
        return parent::edit($model->loadMissing('attachments'));
    }

    public function store(array $data): array
    {
        $media = $data['media'] ?? null;
        unset($data['media']);

        $slider = Slider::create($data);

        if ($slider && $media instanceof UploadedFile && $media->isValid()) {
            $this->saveAttachment($slider, $media);
        }

        return ['key' => 'success', 'msg' => __('dashboard.sliders.created_successfully')];
    }

    public function update(Model $model, array $data): array
    {
        $media = $data['media'] ?? null;
        unset($data['media']);

        $model->update($data);

        if ($media instanceof UploadedFile && $media->isValid()) {
            foreach ($model->attachments as $attachment) {
                $this->deleteAttachmentFile($attachment);
                $attachment->delete();
            }
            $this->saveAttachment($model, $media);
        }

        return ['key' => 'success', 'msg' => __('dashboard.sliders.updated_successfully')];
    }

    private function saveAttachment(Slider $slider, UploadedFile $file): void
    {
        $disk = 'public_direct';
        $directory = 'attachments/sliders';
        $fileName = time() . '_' . rand(1111, 9999) . '.' . $file->getClientOriginalExtension();

        if (!Storage::disk($disk)->exists($directory)) {
            Storage::disk($disk)->makeDirectory($directory);
        }

        $file->storeAs($directory, $fileName, $disk);

        $slider->attachments()->create([
            'disk'          => $disk,
            'file_name'     => $fileName,
            'original_name' => $file->getClientOriginalName(),
            'mime'          => $file->getMimeType(),
            'size'          => $file->getSize(),
            'variants'      => null,
        ]);
    }

    private function deleteAttachmentFile(Attachment $attachment): void
    {
        $filePath = storage_path('app/public/attachments/sliders/' . $attachment->file_name);
        if (file_exists($filePath)) {
            unlink($filePath);
        }
    }
}
