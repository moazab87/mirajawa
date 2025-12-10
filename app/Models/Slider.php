<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Slider extends Model
{
    use SoftDeletes;

    const FILE_KEY          = 'image';
    const IMAGEPATH         = 'sliders';
    const FOLDER_NAME       = 'sliders';
    const SINGLE_NAME       = 'slider';

    protected $fillable = [
        'is_active',
    ];

    protected $casts = [
        'is_active' => 'boolean',
    ];

    /**
     * Get all attachments for the slider (images/videos).
     */
    public function attachments(): MorphMany
    {
        return $this->morphMany(Attachment::class, 'attachable');
    }

    /**
     * Get the main image attachment.
     */
    public function image()
    {
        return $this->attachments()->where('mime', 'like', 'image/%')->first();
    }

    /**
     * Get the main video attachment.
     */
    public function video()
    {
        return $this->attachments()->where('mime', 'like', 'video/%')->first();
    }
}

