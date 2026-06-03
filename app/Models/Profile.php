<?php

namespace App\Models;

use App\Enums\GeneralStatusEnum;
use App\Traits\HasGeneralStatus;
use App\Traits\TranslatableDisplayTrait;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\Translatable\HasTranslations;

class Profile extends Model
{
    use SoftDeletes, HasTranslations, HasGeneralStatus, TranslatableDisplayTrait;

    const FOLDER_NAME = 'profiles';
    const SINGLE_NAME = 'profile';

    protected $fillable = ['name', 'description', 'status'];

    public array $translatable = ['name', 'description'];

    const SEARCH_ATTRIBUTES = ['name', 'description'];

    protected $casts = [
        'status' => GeneralStatusEnum::class,
    ];
}
