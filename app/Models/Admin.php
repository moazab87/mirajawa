<?php

namespace App\Models;

use App\Traits\UploadTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Spatie\Permission\Traits\HasRoles;

class Admin extends AuthBaseModel
{
    use Notifiable, HasApiTokens, SoftDeletes, HasFactory, UploadTrait, HasRoles;

    const FILE_KEY          = 'image';
    const IMAGEPATH         = 'admins';
    const FOLDER_NAME       = 'admins';
    const SINGLE_NAME       = 'admin';

    protected $fillable = [
        'name',
        'phone',
        'email',
        'password',
        'image',
        'is_notify',
        'is_blocked',
        'type',
    ];


    protected $casts = [
        'is_notify'  => 'boolean',
        'is_blocked' => 'boolean',
    ];


}
