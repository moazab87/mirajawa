<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\Translatable\HasTranslations;

class Category extends Model
{
    use SoftDeletes, HasTranslations;

    const FILE_KEY          = 'image';
    const IMAGEPATH         = 'categories';
    const FOLDER_NAME       = 'categories';
    const SINGLE_NAME       = 'category';

    protected $fillable = [
        'name',
        'description',
    ];

    public array $translatable = [
        'name',
        'description',
    ];

    const SEARCH_ATTRIBUTES = ['name', 'description'];

    /**
     * Get the products for the category.
     */
    public function products(): HasMany
    {
        return $this->hasMany(Product::class);
    }

}
