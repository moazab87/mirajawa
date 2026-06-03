<?php

namespace App\Models;

use App\Enums\GeneralStatusEnum;
use App\Traits\HasGeneralStatus;
use App\Traits\TranslatableDisplayTrait;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\Translatable\HasTranslations;

class Slider extends Model
{
    use SoftDeletes, HasTranslations, HasGeneralStatus, TranslatableDisplayTrait;

    const FILE_KEY    = 'image';
    const IMAGEPATH   = 'sliders';
    const FOLDER_NAME = 'sliders';
    const SINGLE_NAME = 'slider';

    protected $fillable = [
        'title',
        'description',
        'status',
    ];

    public array $translatable = [
        'title',
        'description',
    ];

    const SEARCH_ATTRIBUTES = ['title', 'description'];

    protected $casts = [
        'status' => GeneralStatusEnum::class,
    ];

    public function attachments(): MorphMany
    {
        return $this->morphMany(Attachment::class, 'attachable');
    }

    public function image()
    {
        return $this->attachments()->where('mime', 'like', 'image/%')->first();
    }

    public function video()
    {
        return $this->attachments()->where('mime', 'like', 'video/%')->first();
    }
}
