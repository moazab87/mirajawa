<?php

namespace App\Models;

use App\Enums\GeneralStatusEnum;
use App\Traits\HasGeneralStatus;
use App\Traits\TranslatableDisplayTrait;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\Translatable\HasTranslations;

class Category extends Model
{
    use SoftDeletes, HasTranslations, HasGeneralStatus, TranslatableDisplayTrait;

    const FILE_KEY    = 'image';
    const IMAGEPATH   = 'categories';
    const FOLDER_NAME = 'categories';
    const SINGLE_NAME = 'category';

    protected $fillable = [
        'name',
        'description',
        'color',
        'status',
    ];

    public array $translatable = [
        'name',
        'description',
    ];

    const SEARCH_ATTRIBUTES = ['name', 'description'];

    protected $casts = [
        'status' => GeneralStatusEnum::class,
    ];

    public function products(): HasMany
    {
        return $this->hasMany(Product::class);
    }

    public function productGroups(): HasMany
    {
        return $this->hasMany(ProductGroup::class);
    }
}
