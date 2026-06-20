<?php

namespace App\Models;

use App\Enums\GeneralStatusEnum;
use App\Traits\HasGeneralStatus;
use App\Traits\TranslatableDisplayTrait;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\Translatable\HasTranslations;

class Video extends Model
{
    use SoftDeletes, HasTranslations, HasGeneralStatus, TranslatableDisplayTrait;

    const FILE_KEY = 'video';
    const VIDEO_PATH = 'videos';
    const FOLDER_NAME = 'videos';
    const SINGLE_NAME = 'video';

    protected $fillable = [
        'video',
        'title',
        'description',
        'status',
        'sort_order',
    ];

    public array $translatable = [
        'title',
        'description',
    ];

    const SEARCH_ATTRIBUTES = ['title', 'description'];

    protected $casts = [
        'status' => GeneralStatusEnum::class,
        'sort_order' => 'integer',
    ];

    public function scopeOrdered(Builder $query): Builder
    {
        return $query->orderBy('sort_order')->orderByDesc('id');
    }

    public function getVideoUrlAttribute(): ?string
    {
        return $this->video ? asset('uploads/videos/' . $this->video) : null;
    }

    public function getVideoMimeAttribute(): string
    {
        return match (strtolower(pathinfo((string) $this->video, PATHINFO_EXTENSION))) {
            'webm' => 'video/webm',
            'mov' => 'video/quicktime',
            default => 'video/mp4',
        };
    }

    public function hasTextContent(): bool
    {
        return filled($this->getDisplayTranslation('title'))
            || filled(strip_tags((string) $this->getDisplayTranslation('description')));
    }
}
