<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Attachment extends BaseModel
{
    use HasFactory;

    const FILES = ['path'];
    const FILE_PATH = 'attachments';

    protected $fillable = [
        'attachable_id',
        'attachable_type',
        'disk',
        'file_name',
        'original_name',
        'mime',
        'size',
        'variants'
    ];

    protected $casts = [
        'variants' => 'array',
        'size'     => 'integer',
    ];

    public function attachable()
    {
        return $this->morphTo();
    }


}
