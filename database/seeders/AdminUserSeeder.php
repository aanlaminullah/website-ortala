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
            ['email' => 'admin@kominfo.go.id'],
            [
                'name'     => 'Admin Kominfo',
                'username' => 'adminkominfo',
                'role'     => 'admin',
                'email'    => 'admin@kominfo.go.id',
                'password' => Hash::make('K0m!nfo123'),
            ]
        );

        // Operator — akses semua kecuali Pengaturan & Carousel (jika mode hero)
        User::updateOrCreate(
            ['email' => 'admin@ortala.go.id'],
            [
                'name'     => 'Admin Ortala',
                'username' => 'adminortala',
                'role'     => 'operator',
                'email'    => 'admin@ortala.go.id',
                'password' => Hash::make('password123'),
            ]
        );
    }
}
