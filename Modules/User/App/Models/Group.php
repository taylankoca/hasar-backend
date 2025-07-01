<?php

namespace Modules\User\App\Models;

use Illuminate\Database\Eloquent\Model;

class Group extends Model
{
    protected $fillable = [
        'name',
        'members', // JSON: array of emails
    ];

    protected $casts = [
        'members' => 'array',
    ];
} 