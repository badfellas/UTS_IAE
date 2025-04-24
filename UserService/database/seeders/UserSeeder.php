<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;

class UserSeeder extends Seeder
{
    public function run()
    {
        User::create([
            'name' => 'BadfellazXXX',
            'email' => 'BadfellazXXX.com',
        ]);

        User::create([
            'name' => 'Ayu Rahmawati',
            'email' => 'ayu@example.com',
        ]);

        User::create([
            'name' => 'Budi Santoso',
            'email' => 'budi@example.com',
        ]);
    }
}
