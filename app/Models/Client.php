<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Client extends BaseModel
{
    use HasFactory, SoftDeletes;

    const FILE_KEY    = 'image';
    const IMAGEPATH   = 'clients';
    const FOLDER_NAME = 'clients';
    const SINGLE_NAME = 'client';

    protected $fillable = [
        'name',
        'email',
        'phone',
        'image',
        'status',
        'brief',
        'drive_link',
        'account_manager_id',
    ];

    protected $casts = [
        'status' => 'boolean',
    ];

    const SEARCH_ATTRIBUTES = ['name', 'email', 'phone'];

    public function projects(): HasMany
    {
        return $this->hasMany(Project::class);
    }

    public function accountManager()
    {
        return $this->belongsTo(User::class, 'account_manager_id');
    }
}
