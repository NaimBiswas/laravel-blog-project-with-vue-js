<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::create([
            'name' => 'Naim Biswas',
            'email' => 'nayeembiswas2@gmail.com',
            'password' => Hash::make('nayeembiswas2@gmail.com'),
        ]);
    }
}
