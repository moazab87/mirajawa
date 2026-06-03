<?php

namespace App\Models;

use App\Enums\GeneralStatusEnum;
use App\Traits\HasGeneralStatus;
use App\Traits\TranslatableDisplayTrait;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\MorphMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\Translatable\HasTranslations;

class Product extends Model
{
    use SoftDeletes, HasTranslations, HasGeneralStatus, TranslatableDisplayTrait;

    const FILE_KEY    = 'image';
    const IMAGEPATH   = 'products';
    const FOLDER_NAME = 'products';
    const SINGLE_NAME = 'product';

    protected $fillable = [
        'name',
        'description',
        'link',
        'category_id',
        'product_group_id',
        'packaging',
        'country_of_origin',
        'how_to_use',
        'storage_conditions',
        'expiry_date_text',
        'harvest_season',
        'notes',
        'status',
    ];

    public array $translatable = [
        'name',
        'description',
        'packaging',
        'country_of_origin',
        'how_to_use',
        'storage_conditions',
        'expiry_date_text',
        'harvest_season',
        'notes',
    ];

    const SEARCH_ATTRIBUTES = ['name', 'description'];

    protected $casts = [
        'status' => GeneralStatusEnum::class,
    ];

    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }

    public function productGroup(): BelongsTo
    {
        return $this->belongsTo(ProductGroup::class);
    }

    public function attachments(): MorphMany
    {
        return $this->morphMany(Attachment::class, 'attachable');
    }

    public function scopeByCategory(Builder $query, int $categoryId): Builder
    {
        return $query->where('category_id', $categoryId);
    }

    public function scopeByProductGroup(Builder $query, int $productGroupId): Builder
    {
        return $query->where('product_group_id', $productGroupId);
    }
}
