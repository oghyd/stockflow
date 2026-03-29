<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Supplier;

class SupplierSeeder extends Seeder
{
    public function run()
    {
        for ($i = 1; $i <= 5; $i++) {
            Supplier::create([
                'name' => 'Fournisseur ' . $i,
                'email' => 'fournisseur'.$i.'@mail.com',
                'phone' => '060000000'.$i,
                'address' => 'Casablanca',
                'user_id' => 1 // ⚠️ important (doit exister)
            ]);
        }
    }
}
