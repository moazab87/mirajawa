<?php

namespace App\Models;

use App\Enums\GeneralStatusEnum;
use App\Traits\HasGeneralStatus;
use App\Traits\TranslatableDisplayTrait;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\Translatable\HasTranslations;

class Faq extends Model
{
    use SoftDeletes, HasTranslations, HasGeneralStatus, TranslatableDisplayTrait;

    const FOLDER_NAME = 'faqs';
    const SINGLE_NAME = 'faq';

    protected $fillable = ['question', 'answer', 'status'];

    public array $translatable = ['question', 'answer'];

    const SEARCH_ATTRIBUTES = ['question', 'answer'];

    protected $casts = [
        'status' => GeneralStatusEnum::class,
    ];
}
