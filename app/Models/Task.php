<?php

namespace App\Models;

use App\Enums\PriorityTypeEnum;
use App\Enums\StatusModelsEnum;
use App\Enums\TaskStatusTypeEnum;
use App\Helpers\EnumHelper;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\Translatable\HasTranslations;

class Task extends Model
{
    use HasFactory, HasTranslations, SoftDeletes;

    const FILE_KEY          = 'image';
    const IMAGEPATH         = 'tasks';
    const FOLDER_NAME       = 'tasks';
    const SINGLE_NAME       = 'task';
    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'project_id',
        'title',
        'description',
        'status',
        'priority',
        'assignee_id',
        'reporter_id',
        'start_date',
        'due_date',
        'estimated_hours',
        'actual_hours',
        'parent_id',
        'sort_order',
    ];

    const SEARCH_ATTRIBUTES = [
        'title',
        'description',
    ];

    public  $translatable = ['title', 'description'];

    protected $casts = [
        'start_date'      => 'date',
        'due_date'        => 'date',
        'estimated_hours' => 'float',
        'actual_hours'    => 'float',
        'status'          => TaskStatusTypeEnum::class,
        'priority'        => PriorityTypeEnum::class,
    ];

    public function project(): BelongsTo
    {
        return $this->belongsTo(Project::class);
    }

    public function assignee(): BelongsTo
    {
        return $this->belongsTo(User::class, 'assignee_id');
    }

    public function reporter(): BelongsTo
    {
        return $this->belongsTo(User::class, 'reporter_id');
    }

    public function comments(): HasMany
    {
        return $this->hasMany(TaskComment::class);
    }

    public function attachments(): HasMany
    {
        return $this->hasMany(TaskAttachment::class);
    }

    public function activities(): HasMany
    {
        return $this->hasMany(TaskActivity::class);
    }

    public function parent(): BelongsTo
    {
        return $this->belongsTo(Task::class, 'parent_id');
    }

    public function children(): HasMany
    {
        return $this->hasMany(Task::class, 'parent_id');
    }
    public function getStatusTextAttribute()
    {
        return EnumHelper::toResource(
            StatusModelsEnum::class,
            $this->status
        )['title'];
    }
}
