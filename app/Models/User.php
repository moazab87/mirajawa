<?php

namespace App\Models;

use App\Enums\StatusModelsEnum;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Notifications\Notifiable;

class User extends AuthBaseModel
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable;

    const FILE_KEY          = 'image';
    const IMAGEPATH         = 'users';
    const FOLDER_NAME       = 'users';
    const SINGLE_NAME       = 'user';

    const SEARCH_ATTRIBUTES  = ['name', 'email', 'phone'];
    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'name',
        'email',
        'phone',
        'password',
        'role',
        'status',
        'image',
        'email_verified_at',
    ];

    protected $casts = [
        'status'          => StatusModelsEnum::class,
    ];
    
    public function teams()
    {
        return $this->belongsToMany(Team::class, 'team_user')
            ->withPivot(['role', 'is_active'])
            ->withTimestamps();
    }

    public function ownedTeams()
    {
        return $this->hasMany(Team::class, 'leader_id');
    }

    public function assignedTasks()
    {
        return $this->hasMany(Task::class, 'assignee_id');
    }

    public function reportedTasks()
    {
        return $this->hasMany(Task::class, 'reporter_id');
    }
}
