<?php

namespace Modules\Invoice\Database\Seeders;

use Illuminate\Database\Seeder;
use Modules\Invoice\App\Models\Invoice;

class InvoiceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Invoice::create([
            'invoiceNo' => 'INV-001',
            'customerKey' => 'ahmet.yilmaz@example.com',
            'name' => 'Ahmet',
            'surname' => 'Yılmaz',
            'amount' => 250.00,
            'dueDate' => '2024-08-15',
            'paymentType' => 'Credit Card',
            'status' => 'Pending',
        ]);
        echo "Invoice: INV-001 eklendi\n";
        Invoice::create([
            'invoiceNo' => 'INV-002',
            'customerKey' => 'info@acme.com',
            'name' => 'Acme A.Ş.',
            'surname' => null,
            'amount' => 1500.75,
            'dueDate' => '2024-09-01',
            'paymentType' => 'Bank Transfer',
            'status' => 'Paid',
        ]);
        echo "Invoice: INV-002 eklendi\n";
    }
}
