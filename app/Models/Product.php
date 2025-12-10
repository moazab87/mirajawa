<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\MorphMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\Translatable\HasTranslations;

class Product extends Model
{
    use SoftDeletes, HasTranslations;

    const FILE_KEY          = 'image';
    const IMAGEPATH         = 'products';
    const FOLDER_NAME       = 'products';
    const SINGLE_NAME       = 'product';

    protected $fillable = [
        'name',
        'description',
        'link',
        'category_id',
    ];

    public array $translatable = [
        'name',
        'description',
    ];

    const SEARCH_ATTRIBUTES = ['name', 'description'];

    /**
     * Get the category that owns the product.
     */
    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }

    /**
     * Get all attachments for the product.
     */
    public function attachments(): MorphMany
    {
        return $this->morphMany(Attachment::class, 'attachable');
    }
}

