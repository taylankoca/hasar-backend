<?php

namespace Modules\User\App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    protected $fillable = [
        'name',
        'surname',
        'email',
        'password',
        'avatarUrl',
    ];

    protected $hidden = [
        'password',
    ];

    protected $table = 'module_user_users';
} 