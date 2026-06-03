<?php

namespace App\Models;

use App\Enums\GeneralStatusEnum;
use App\Traits\HasGeneralStatus;
use App\Traits\TranslatableDisplayTrait;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\Translatable\HasTranslations;

class InformationBlock extends Model
{
    use SoftDeletes, HasTranslations, HasGeneralStatus, TranslatableDisplayTrait;

    const FOLDER_NAME = 'informationBlocks';
    const SINGLE_NAME = 'informationBlock';

    protected $fillable = ['name', 'description', 'status'];

    public array $translatable = ['name', 'description'];

    const SEARCH_ATTRIBUTES = ['name', 'description'];

    protected $casts = [
        'status' => GeneralStatusEnum::class,
    ];
}
