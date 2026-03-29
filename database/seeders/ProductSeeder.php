<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Product;

class ProductSeeder extends Seeder
{
    public function run()
    {
        for ($i = 1; $i <= 10; $i++) {
            Product::create([
                'name' => 'Produit ' . $i,
                'description' => 'Description produit ' . $i,
                'purchase_price' => rand(50, 200),
                'sale_price' => rand(200, 500),
                'stock_quantity' => rand(1, 20),
                'alert_threshold' => 5,
                'category_id' => rand(1, 5),
                'supplier_id' => rand(1, 5),
            ]);
        }
    }
}