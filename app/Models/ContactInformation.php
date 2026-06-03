<?php

namespace App\Models;

use App\Enums\GeneralStatusEnum;
use App\Traits\HasGeneralStatus;
use App\Traits\TranslatableDisplayTrait;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\Translatable\HasTranslations;

class ContactInformation extends Model
{
    use SoftDeletes, HasTranslations, HasGeneralStatus, TranslatableDisplayTrait;

    const FILE_KEY = 'image';
    const IMAGEPATH = 'contact_information';
    const FOLDER_NAME = 'contactInformation';
    const SINGLE_NAME = 'contactInformation';

    protected $table = 'contact_information';

    protected $fillable = ['name', 'description', 'image', 'phone', 'status'];

    public array $translatable = ['name', 'description'];

    const SEARCH_ATTRIBUTES = ['name', 'description', 'phone'];

    protected $casts = [
        'status' => GeneralStatusEnum::class,
    ];

    public function getImageUrlAttribute(): ?string
    {
        return $this->image ? asset('uploads/' . self::IMAGEPATH . '/' . $this->image) : null;
    }
}
