<?php

namespace App\Models;

use App\Enums\MessageStatusEnum;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ContactMessage extends Model
{
    use SoftDeletes;

    const FOLDER_NAME = 'contactMessages';
    const SINGLE_NAME = 'contactMessage';

    protected $fillable = ['name', 'email', 'company_name', 'phone', 'message', 'status'];

    const SEARCH_ATTRIBUTES = ['name', 'email', 'company_name', 'phone', 'message'];

    protected $casts = [
        'status' => MessageStatusEnum::class,
    ];
}
