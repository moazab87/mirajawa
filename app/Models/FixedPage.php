<?php

namespace App\Models;

use App\Enums\GeneralStatusEnum;
use App\Traits\HasGeneralStatus;
use App\Traits\TranslatableDisplayTrait;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Str;
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

    public static function generateSlug(array $name): string
    {
        $source = $name['en'] ?? $name['ar'] ?? $name['ja'] ?? 'page';

        return Str::slug($source);
    }

    public function getImageUrlAttribute(): ?string
    {
        return $this->image ? asset('uploads/' . self::IMAGEPATH . '/' . $this->image) : null;
    }
}
