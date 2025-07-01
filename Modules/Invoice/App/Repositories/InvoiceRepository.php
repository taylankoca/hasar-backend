<?php

namespace Modules\Invoice\App\Repositories;

use Modules\Invoice\App\Models\Invoice;

class InvoiceRepository
{
    public function all()
    {
        return Invoice::all();
    }

    public function find($id)
    {
        return Invoice::find($id);
    }

    public function create(array $data)
    {
        return Invoice::create($data);
    }
} 