<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        User::insert([
            [
                'username' => 'adelawi',
                'nama' => 'Ade Alawi Hasan',
                'password' => bcrypt('bigFamily3'),
                'level' => 'admin',
            ],[
                'username' => 'admin',
                'nama' => 'Administrator',
                'password' => bcrypt('FollSMK4MS'),
                'level' => 'admin',
            ],
        ]);
    }
}
