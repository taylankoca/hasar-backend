<?php

namespace Modules\Invoice\App\Models;

use Illuminate\Database\Eloquent\Model;

class Invoice extends Model
{
    protected $fillable = [
        'invoiceNo',
        'customerKey', // email
        'name',
        'surname',
        'amount',
        'dueDate',
        'paymentType',
        'status',
    ];

    protected $table = 'module_invoice_invoices';
} 