<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class AdminUserSeeder extends Seeder
{
    public function run()
    {
        User::create([
            'name' => 'Admin',
            'email' => 'office@manufacturedmovablehomes.online',
            'password' => Hash::make('office@manufacturedmovablehomes.online5@'),
            'role' => 'admin',
            'email_verified_at' => now(),
        ]);
    }
}
