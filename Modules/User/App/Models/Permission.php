<?php

namespace Modules\User\App\Models;

use Illuminate\Database\Eloquent\Model;

class Permission extends Model
{
    protected $fillable = [
        'module', // Customers, Invoices, Settings
        'permissions', // JSON: {view, create, edit, delete}
    ];

    protected $casts = [
        'permissions' => 'array',
    ];
} 