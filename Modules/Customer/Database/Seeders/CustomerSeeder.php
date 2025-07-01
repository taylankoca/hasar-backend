<?php

namespace Modules\Customer\Database\Seeders;

use Illuminate\Database\Seeder;
use Modules\Customer\App\Models\Customer;

class CustomerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Customer::create([
            'customerType' => 'Bireysel',
            'name' => 'Ahmet',
            'surname' => 'Yılmaz',
            'email' => 'ahmet.yilmaz@example.com',
            'phone' => '(555) 0101',
            'address' => 'Yıldız Mah. Çırağan Cad. No:1, Beşiktaş, İstanbul',
            'createdAt' => '2023-01-15',
            'tckn' => '12345678901',
            'vkn' => null,
        ]);
        echo "Customer: ahmet.yilmaz@example.com eklendi\n";
        Customer::create([
            'customerType' => 'Kurumsal',
            'name' => 'Acme A.Ş.',
            'surname' => null,
            'email' => 'info@acme.com',
            'phone' => '(212) 123 45 67',
            'address' => 'Acme Plaza, Maslak, İstanbul',
            'createdAt' => '2023-02-10',
            'tckn' => null,
            'vkn' => '1112223334',
        ]);
        echo "Customer: info@acme.com eklendi\n";
    }
}
