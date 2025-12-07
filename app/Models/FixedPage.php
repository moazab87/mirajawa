<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\Translatable\HasTranslations;

class FixedPage extends Model
{
    use SoftDeletes, HasTranslations;

    const FILE_KEY          = 'image';
    const IMAGEPATH         = 'fixedPages';
    const FOLDER_NAME       = 'fixedPages';
    const SINGLE_NAME       = 'fixedPage';

    protected $fillable = [
        'name',
        'content',
    ];

    public array $translatable = [
        'name',
        'content',
    ];

    const SEARCH_ATTRIBUTES = ['name', 'content'];

}
