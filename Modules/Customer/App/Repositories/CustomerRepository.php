<?php

namespace Modules\Customer\App\Repositories;

use Modules\Customer\App\Models\Customer;

class CustomerRepository
{
    public function all()
    {
        return Customer::all();
    }

    public function find($id)
    {
        return Customer::find($id);
    }

    public function create(array $data)
    {
        return Customer::create($data);
    }
} 