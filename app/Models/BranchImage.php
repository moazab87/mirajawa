<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class BranchImage extends Model
{
    const IMAGEPATH = 'branches';

    protected $fillable = ['branch_id', 'image'];

    public function branch(): BelongsTo
    {
        return $this->belongsTo(Branch::class);
    }

    public function getImageUrlAttribute(): string
    {
        return asset('uploads/' . self::IMAGEPATH . '/' . $this->image);
    }
}
