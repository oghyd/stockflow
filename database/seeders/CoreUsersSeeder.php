<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CoreUsersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::firstOrCreate(
            ['email' => 'admin@test.com'],
            [
                'name' => 'Admin User',
                'password' => bcrypt('password'),
            ]
        )->assignRole('admin');

        User::firstOrCreate(
            ['email' => 'vendeur@test.com'],
            [
                'name' => 'Vendeur User',
                'password' => bcrypt('password'),
            ]
        )->assignRole('vendeur');

        User::firstOrCreate(
            ['email' => 'fournisseur@test.com'],
            [
                'name' => 'Fournisseur User',
                'password' => bcrypt('password'),
            ]
        )->assignRole('fournisseur');
    }
}

