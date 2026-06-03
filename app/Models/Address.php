<?php

namespace App\Models;

use App\Enums\GeneralStatusEnum;
use App\Traits\HasGeneralStatus;
use App\Traits\TranslatableDisplayTrait;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\Translatable\HasTranslations;

class Address extends Model
{
    use SoftDeletes, HasTranslations, HasGeneralStatus, TranslatableDisplayTrait;

    const FILE_KEY = 'image';
    const FOLDER_NAME = 'addresses';
    const SINGLE_NAME = 'address';

    protected $fillable = ['name', 'description', 'map_desc', 'address', 'lat', 'lng', 'status'];

    public array $translatable = ['name', 'description', 'map_desc'];

    const SEARCH_ATTRIBUTES = ['name', 'description', 'address'];

    protected $casts = [
        'status' => GeneralStatusEnum::class,
        'lat'    => 'decimal:7',
        'lng'    => 'decimal:7',
    ];
}
