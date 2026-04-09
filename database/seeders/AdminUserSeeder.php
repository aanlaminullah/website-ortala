<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class AdminUserSeeder extends Seeder
{
    public function run(): void
    {
        // Admin — akses penuh termasuk Pengaturan
        User::updateOrCreate(
            ['email' => 'admin@ortala.go.id'],
            [
                'name'     => 'Administrator',
                'role'     => 'admin',
                'email'    => 'admin@ortala.go.id',
                'password' => Hash::make('password123'),
            ]
        );

        // Operator — akses semua kecuali Pengaturan & Carousel (jika mode hero)
        User::updateOrCreate(
            ['email' => 'operator@ortala.go.id'],
            [
                'name'     => 'Operator',
                'role'     => 'operator',
                'email'    => 'operator@ortala.go.id',
                'password' => Hash::make('operator123'),
            ]
        );
    }
}
