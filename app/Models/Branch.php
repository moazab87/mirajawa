<?php

namespace App\Models;

use App\Enums\GeneralStatusEnum;
use App\Traits\HasGeneralStatus;
use App\Traits\TranslatableDisplayTrait;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\Translatable\HasTranslations;

class Branch extends Model
{
    use SoftDeletes, HasTranslations, HasGeneralStatus, TranslatableDisplayTrait;

    const FOLDER_NAME = 'branches';
    const SINGLE_NAME = 'branch';

    protected $fillable = ['name', 'description', 'status'];

    public array $translatable = ['name', 'description'];

    const SEARCH_ATTRIBUTES = ['name', 'description'];

    protected $casts = [
        'status' => GeneralStatusEnum::class,
    ];

    public function images(): HasMany
    {
        return $this->hasMany(BranchImage::class);
    }
}
