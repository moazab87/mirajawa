<?php

namespace App\Models;

use App\Enums\MessageStatusEnum;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class InformationRequest extends Model
{
    use SoftDeletes;

    const FOLDER_NAME = 'informationRequests';
    const SINGLE_NAME = 'informationRequest';

    protected $fillable = ['name', 'email', 'company_name', 'phone', 'message', 'address', 'postal_code', 'status'];

    const SEARCH_ATTRIBUTES = ['name', 'email', 'company_name', 'phone', 'message', 'address', 'postal_code'];

    protected $casts = [
        'status' => MessageStatusEnum::class,
    ];
}
