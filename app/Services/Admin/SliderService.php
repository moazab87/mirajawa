<?php

namespace App\Services\Admin;

use App\Models\Slider;
use Illuminate\Contracts\View\View;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;

class SliderService
{
    /**
     * Static page meta shared between create/edit.
     */
    private function basePageData(): array
    {
        return [
            'active'     => 'sliders',
            'title'      => __('route.sliders.index'),
            'singleName' => 'slider',
            'route'      => route('admin.sliders.index'),
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
        return $this->renderForm('admin.sliders.create', [
            'subTitle'   => __('route.sliders.create'),
            'storeRoute' => route('admin.sliders.store'),
        ]);
    }

    public function edit(Slider $slider): View
    {
        return $this->renderForm('admin.sliders.edit', [
            'subTitle'    => __('route.sliders.edit'),
            'updateRoute' => route('admin.sliders.update', $slider->id),
            'model'       => $slider->loadMissing('attachments'),
        ]);
    }

    public function store(array $data): array
    {
        // Extract media file from data
        $media = $data['media'] ?? null;
        unset($data['media']);

        $slider = Slider::create($data);

        // Handle media file (image or video)
        if ($slider && $media && $media instanceof \Illuminate\Http\UploadedFile && $media->isValid()) {
            $this->saveAttachment($slider, $media);
        }

        return ['key' => 'success', 'msg' => __('admin.successMessageText')];
    }

    public function update(Slider $slider, array $data): array
    {
        // Extract media file from data
        $media = $data['media'] ?? null;
        unset($data['media']);

        $updated = $slider->update($data);

        // Handle new media file (image or video)
        // If new media is uploaded, delete old attachments and save new one
        if ($updated && $media && $media instanceof \Illuminate\Http\UploadedFile && $media->isValid()) {
            // Delete existing attachments
            foreach ($slider->attachments as $attachment) {
                $filePath = storage_path('app/public/attachments/sliders/' . $attachment->file_name);
                if (file_exists($filePath)) {
                    unlink($filePath);
                }
                $attachment->delete();
            }
            
            // Save new attachment
            $this->saveAttachment($slider, $media);
        }

        return ['key' => 'success', 'msg' => __('admin.editSuccessMessageText')];
    }

    /**
     * Save a single attachment (image or video) for the slider.
     */
    private function saveAttachment(Slider $slider, UploadedFile $file): void
    {
        if ($file->isValid()) {
            $disk = 'public';
            $directory = 'attachments/sliders';
            $fileName = time() . '_' . rand(1111, 9999) . '.' . $file->getClientOriginalExtension();
            
            // Ensure directory exists
            if (!Storage::disk($disk)->exists($directory)) {
                Storage::disk($disk)->makeDirectory($directory);
            }
            
            // Store the file
            $file->storeAs($directory, $fileName, $disk);
            
            // Create attachment record
            $slider->attachments()->create([
                'disk'          => $disk,
                'file_name'     => $fileName,
                'original_name' => $file->getClientOriginalName(),
                'mime'          => $file->getMimeType(),
                'size'          => $file->getSize(),
                'variants'      => null,
            ]);
        }
    }
}

