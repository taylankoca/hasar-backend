<?php

namespace Modules\User\Database\Seeders;

use Illuminate\Database\Seeder;
use Modules\User\App\Models\User;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::create([
            'name' => 'Ahmet',
            'surname' => 'Yılmaz',
            'email' => 'ahmet.yilmaz@example.com',
            'password' => bcrypt('password'),
            'avatarUrl' => 'https://placehold.co/100x100.png',
        ]);
        echo "User: ahmet.yilmaz@example.com eklendi\n";
        User::create([
            'name' => 'Ayşe',
            'surname' => 'Kara',
            'email' => 'ayse.kara@example.com',
            'password' => bcrypt('password'),
            'avatarUrl' => 'https://placehold.co/100x100.png',
        ]);
        echo "User: ayse.kara@example.com eklendi\n";
    }
}
