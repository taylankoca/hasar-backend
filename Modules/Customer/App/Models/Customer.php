<?php

namespace Modules\Customer\App\Models;

use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    protected $fillable = [
        'customerType', // Bireysel/Kurumsal
        'name',
        'surname',
        'email',
        'phone',
        'address',
        'createdAt',
        'tckn',
        'vkn',
    ];

    protected $table = 'module_customer_customers';
} 