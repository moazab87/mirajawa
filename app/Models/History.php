<?php

namespace App\Models;

use App\Enums\GeneralStatusEnum;
use App\Traits\HasGeneralStatus;
use App\Traits\TranslatableDisplayTrait;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\Translatable\HasTranslations;

class History extends Model
{
    use SoftDeletes, HasTranslations, HasGeneralStatus, TranslatableDisplayTrait;

    const FOLDER_NAME = 'histories';
    const SINGLE_NAME = 'history';

    protected $fillable = ['year', 'name', 'description', 'status'];

    public array $translatable = ['name', 'description'];

    const SEARCH_ATTRIBUTES = ['year', 'name', 'description'];

    protected $casts = [
        'year' => 'integer',
        'status' => GeneralStatusEnum::class,
    ];

    public function scopeOrderForAdmin(Builder $query): Builder
    {
        return $query
            ->orderByRaw('year IS NULL')
            ->orderByDesc('year')
            ->orderByDesc('id');
    }

    public function scopeOrderForTimeline(Builder $query): Builder
    {
        return $query
            ->orderByRaw('year IS NULL')
            ->orderBy('year');
    }
}
