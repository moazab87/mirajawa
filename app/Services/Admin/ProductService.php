<?php

namespace App\Services\Admin;

use App\Models\Attachment;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Contracts\View\View;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;

class ProductService
{
    private function dropdowns(): array
    {
        $categories = Category::query()
            ->select('id', 'name')
            ->orderBy('id')
            ->get()
            ->mapWithKeys(function ($category) {
                return [$category->id => $category->getTranslation('name', app()->getLocale())];
            })
            ->toArray();

        return compact('categories');
    }

    /**
     * Static page meta shared between create/edit.
     */
    private function basePageData(): array
    {
        return [
            'active'     => 'products',
            'title'      => __('route.products.index'),
            'singleName' => 'product',
            'route'      => route('admin.products.index'),
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
        return $this->renderForm('admin.products.create', [
            'subTitle'   => __('route.products.create'),
            'storeRoute' => route('admin.products.store'),
        ]);
    }

    public function edit(Product $product): View
    {
        return $this->renderForm('admin.products.edit', [
            'subTitle'    => __('route.products.edit'),
            'updateRoute' => route('admin.products.update', $product->id),
            'model'       => $product->loadMissing('attachments', 'category'),
        ]);
    }

    public function store(array $data): array
    {
        // Extract images and videos from data
        $images = $data['images'] ?? [];
        $videos = $data['videos'] ?? [];
        unset($data['images'], $data['videos']);

        $product = Product::create($data);

        // Handle images
        if ($product && !empty($images)) {
            $this->saveAttachments($product, $images);
        }

        // Handle videos
        if ($product && !empty($videos)) {
            $this->saveAttachments($product, $videos);
        }

        return ['key' => 'success', 'msg' => __('admin.successMessageText')];
    }

    public function update(Product $product, array $data): array
    {
        // Extract images and videos from data
        $images = $data['images'] ?? [];
        $videos = $data['videos'] ?? [];
        unset($data['images'], $data['videos']);

        $updated = $product->update($data);

        // Handle new images
        if ($updated && !empty($images)) {
            $this->saveAttachments($product, $images);
        }

        // Handle new videos
        if ($updated && !empty($videos)) {
            $this->saveAttachments($product, $videos);
        }

        return ['key' => 'success', 'msg' => __('admin.editSuccessMessageText')];
    }

    /**
     * Save attachments for the product.
     */
    private function saveAttachments(Product $product, array $attachments): void
    {
        foreach ($attachments as $file) {
            if ($file instanceof UploadedFile && $file->isValid()) {
                $disk = 'public';
                $directory = 'attachments/products';
                $fileName = time() . '_' . rand(1111, 9999) . '.' . $file->getClientOriginalExtension();
                
                // Ensure directory exists
                if (!Storage::disk($disk)->exists($directory)) {
                    Storage::disk($disk)->makeDirectory($directory);
                }
                
                // Store the file
                $path = $file->storeAs($directory, $fileName, $disk);
                
                // Create attachment record
                $product->attachments()->create([
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
}

