<?php

namespace App\Models;

use App\Enums\StatusModelsEnum;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\Translatable\HasTranslations;

class Project extends BaseModel
{
    use SoftDeletes, HasTranslations;

    const FILE_KEY          = 'image';
    const IMAGEPATH         = 'projects';
    const FOLDER_NAME       = 'projects';
    const SINGLE_NAME       = 'project';

    protected $fillable = [
        'team_id',
        'client_id',
        'name',
        'description',
        'status',
        'start_date',
        'end_date',
        'created_by',
    ];

    public $translatable = [
        'name',
        'description',
    ];

    protected $casts = [
        'name'       => 'json',
        'start_date' => 'date',
        'end_date'   => 'date',
        'status'     => StatusModelsEnum::class,
    ];

    const SEARCH_ATTRIBUTES  = ['name', 'description'];

    public function team(): BelongsTo
    {
        return $this->belongsTo(Team::class);
    }

    public function creator(): BelongsTo
    {
        return $this->belongsTo(Admin::class, 'created_by');
    }

    public function tasks(): HasMany
    {
        return $this->hasMany(Task::class);
    }

    public function client(): BelongsTo
    {
        return $this->belongsTo(Client::class);
    }
}
