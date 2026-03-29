<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Category;

class CategorySeeder extends Seeder
{
    public function run()
    {
        $categories = [
            'Informatique',
            'Téléphone',
            'Accessoires',
            'Électroménager',
            'Gaming'
        ];

        foreach ($categories as $cat) {
            Category::create([
                'name' => $cat,
                'description' => $cat . ' description'
            ]);
        }
    }
}

