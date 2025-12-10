<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Social extends Model
{
    use SoftDeletes;

    const FILE_KEY          = null;
    const IMAGEPATH         = 'socials';
    const FOLDER_NAME       = 'socials';
    const SINGLE_NAME       = 'social';

    protected $fillable = [
        'name',
        'url',
        'icon',
        'is_active',
    ];

    protected $casts = [
        'is_active' => 'boolean',
    ];

    const SEARCH_ATTRIBUTES = ['name', 'url'];
}

