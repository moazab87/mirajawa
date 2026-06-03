<?php

namespace App\Services\Admin;

use App\Models\Attachment;
use App\Models\Category;
use App\Models\Product;
use App\Models\ProductGroup;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;

class ProductService extends AbstractAdminCrudService
{
    protected function modelClass(): string
    {
        return Product::class;
    }

    protected function activeKey(): string
    {
        return 'products';
    }

    protected function routeKey(): string
    {
        return 'products';
    }

    protected function singleName(): string
    {
        return 'product';
    }

    protected function dropdowns(): array
    {
        return [
            'categories'     => $this->mapCategories(),
            'productGroups'  => $this->mapProductGroups(),
        ];
    }

    public function indexExtraData(Request $request): array
    {
        return [
            'categories'    => Category::orderBy('id')->get(),
            'productGroups' => ProductGroup::orderBy('id')->get(),
        ];
    }

    public function edit(Model $model): \Illuminate\Contracts\View\View
    {
        return parent::edit($model->loadMissing('attachments', 'category', 'productGroup'));
    }

    public function store(array $data): array
    {
        $images = $data['images'] ?? [];
        $videos = $data['videos'] ?? [];
        unset($data['images'], $data['videos']);

        $product = Product::create($data);

        if (!empty($images)) {
            $this->saveAttachments($product, $images);
        }
        if (!empty($videos)) {
            $this->saveAttachments($product, $videos);
        }

        return ['key' => 'success', 'msg' => __('dashboard.products.created_successfully')];
    }

    public function update(Model $model, array $data): array
    {
        $images = $data['images'] ?? [];
        $videos = $data['videos'] ?? [];
        unset($data['images'], $data['videos']);

        $model->update($data);

        if (!empty($images)) {
            $this->saveAttachments($model, $images);
        }
        if (!empty($videos)) {
            $this->saveAttachments($model, $videos);
        }

        return ['key' => 'success', 'msg' => __('dashboard.products.updated_successfully')];
    }

    private function mapCategories(): array
    {
        return Category::query()->orderBy('id')->get()->mapWithKeys(function ($category) {
            return [$category->id => $category->getDisplayTranslation('name')];
        })->toArray();
    }

    private function mapProductGroups(): array
    {
        return ProductGroup::query()->with('category')->orderBy('id')->get()->mapWithKeys(function ($group) {
            return [$group->id => $group->getDisplayTranslation('name')];
        })->toArray();
    }

    private function saveAttachments(Product $product, array $attachments): void
    {
        foreach ($attachments as $file) {
            if ($file instanceof UploadedFile && $file->isValid()) {
                $disk = 'public_direct';
                $directory = 'attachments/products';
                $fileName = time() . '_' . rand(1111, 9999) . '.' . $file->getClientOriginalExtension();

                if (!Storage::disk($disk)->exists($directory)) {
                    Storage::disk($disk)->makeDirectory($directory);
                }

                $file->storeAs($directory, $fileName, $disk);

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
