<?php

namespace App\Models;

use App\Enums\FixedPageSlugEnum;
use App\Enums\GeneralStatusEnum;
use App\Traits\HasGeneralStatus;
use App\Traits\TranslatableDisplayTrait;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\Translatable\HasTranslations;

class FixedPage extends Model
{
    use SoftDeletes, HasTranslations, HasGeneralStatus, TranslatableDisplayTrait;

    const FILE_KEY    = 'image';
    const IMAGEPATH   = 'fixedPages';
    const FOLDER_NAME = 'fixedPages';
    const SINGLE_NAME = 'fixedPage';

    protected $fillable = [
        'slug',
        'name',
        'sub_title',
        'description',
        'image',
        'status',
    ];

    public array $translatable = [
        'name',
        'sub_title',
        'description',
    ];

    const SEARCH_ATTRIBUTES = ['name', 'description', 'slug'];

    protected $casts = [
        'status' => GeneralStatusEnum::class,
    ];

    protected static function booted(): void
    {
        static::creating(function (FixedPage $page) {
            if (! app()->runningInConsole()) {
                return false;
            }
        });

        static::updating(function (FixedPage $page) {
            if ($page->isDirty('slug')) {
                $page->slug = $page->getOriginal('slug');
            }
        });

        static::deleting(function (FixedPage $page) {
            if (FixedPageSlugEnum::isSystemSlug($page->slug) && ! app()->runningInConsole()) {
                return false;
            }
        });
    }

    public function scopeWhereSlug($query, string $slug)
    {
        return $query->where('slug', $slug);
    }

    public function isSystemPage(): bool
    {
        return FixedPageSlugEnum::isSystemSlug($this->slug);
    }

    public function getImageUrlAttribute(): ?string
    {
        return $this->image ? asset('uploads/' . self::IMAGEPATH . '/' . $this->image) : null;
    }
}
