<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Product;
use App\Models\Supplier;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class DemoDataSeeder extends Seeder
{
    public function run(): void
    {
        /*
        |--------------------------------------------------------------------------
        | 1) Create vendeur users
        |--------------------------------------------------------------------------
        */
        for ($i = 1; $i <= 10; $i++) {
            $vendeur = User::updateOrCreate(
                ['email' => "vendeur{$i}@stockflow.test"],
                [
                    'name' => "Vendeur {$i}",
                    'password' => Hash::make('password'),
                ]
            );

            $vendeur->syncRoles(['vendeur']);
        }

        /*
        |--------------------------------------------------------------------------
        | 2) Create fournisseur users + supplier records
        |--------------------------------------------------------------------------
        */
        $suppliersData = [
            [
                'user_name' => 'Fournisseur Alpha',
                'user_email' => 'fournisseur1@stockflow.test',
                'supplier_name' => 'Alpha Distribution',
                'phone' => '0600000001',
                'address' => 'Casablanca',
            ],
            [
                'user_name' => 'Fournisseur Beta',
                'user_email' => 'fournisseur2@stockflow.test',
                'supplier_name' => 'Beta Market Supply',
                'phone' => '0600000002',
                'address' => 'Rabat',
            ],
            [
                'user_name' => 'Fournisseur Gamma',
                'user_email' => 'fournisseur3@stockflow.test',
                'supplier_name' => 'Gamma Wholesale',
                'phone' => '0600000003',
                'address' => 'Marrakech',
            ],
            [
                'user_name' => 'Fournisseur Delta',
                'user_email' => 'fournisseur4@stockflow.test',
                'supplier_name' => 'Delta Food Trade',
                'phone' => '0600000004',
                'address' => 'Fes',
            ],
            [
                'user_name' => 'Fournisseur Sigma',
                'user_email' => 'fournisseur5@stockflow.test',
                'supplier_name' => 'Sigma Store Partners',
                'phone' => '0600000005',
                'address' => 'Tangier',
            ],
            [
                'user_name' => 'Fournisseur Omega',
                'user_email' => 'fournisseur6@stockflow.test',
                'supplier_name' => 'Omega Retail Source',
                'phone' => '0600000006',
                'address' => 'Agadir',
            ],
        ];

        $suppliers = collect();

        foreach ($suppliersData as $data) {
            $fournisseurUser = User::updateOrCreate(
                ['email' => $data['user_email']],
                [
                    'name' => $data['user_name'],
                    'password' => Hash::make('password'),
                ]
            );

            $fournisseurUser->syncRoles(['fournisseur']);

            $supplier = Supplier::updateOrCreate(
                ['name' => $data['supplier_name']],
                [
                    'email' => $data['user_email'],
                    'phone' => $data['phone'],
                    'address' => $data['address'],
                    'user_id' => $fournisseurUser->id,
                ]
            );

            $suppliers->push($supplier);
        }

        /*
        |--------------------------------------------------------------------------
        | 3) Create categories
        |--------------------------------------------------------------------------
        */
        $categoriesData = [
            [
                'name' => 'Boissons',
                'description' => 'Soft drinks, juices, and bottled water',
            ],
            [
                'name' => 'Snacks',
                'description' => 'Chips, biscuits, and quick snacks',
            ],
            [
                'name' => 'Hygiène',
                'description' => 'Personal care and hygiene products',
            ],
            [
                'name' => 'Entretien',
                'description' => 'Cleaning and household products',
            ],
        ];

        $categories = collect();

        foreach ($categoriesData as $data) {
            $category = Category::updateOrCreate(
                ['name' => $data['name']],
                ['description' => $data['description']]
            );

            $categories->push($category);
        }

        /*
        |--------------------------------------------------------------------------
        | 4) Create products
        |--------------------------------------------------------------------------
        */
        $productsData = [
            ['name' => 'Coca-Cola 1L', 'description' => 'Soft drink bottle 1 liter', 'purchase_price' => 6.50, 'sale_price' => 9.50, 'stock_quantity' => 30, 'alert_threshold' => 8],
            ['name' => 'Orange Juice 1L', 'description' => 'Natural orange juice', 'purchase_price' => 8.00, 'sale_price' => 12.00, 'stock_quantity' => 18, 'alert_threshold' => 6],
            ['name' => 'Mineral Water 1.5L', 'description' => 'Still mineral water', 'purchase_price' => 2.50, 'sale_price' => 4.00, 'stock_quantity' => 50, 'alert_threshold' => 10],
            ['name' => 'Potato Chips', 'description' => 'Salted potato chips', 'purchase_price' => 4.00, 'sale_price' => 7.00, 'stock_quantity' => 22, 'alert_threshold' => 5],
            ['name' => 'Chocolate Biscuits', 'description' => 'Crunchy chocolate biscuits', 'purchase_price' => 5.50, 'sale_price' => 8.50, 'stock_quantity' => 16, 'alert_threshold' => 5],
            ['name' => 'Energy Bar', 'description' => 'Cereal and peanut bar', 'purchase_price' => 3.00, 'sale_price' => 5.00, 'stock_quantity' => 28, 'alert_threshold' => 7],
            ['name' => 'Shampoo 400ml', 'description' => 'Hair care shampoo', 'purchase_price' => 18.00, 'sale_price' => 26.00, 'stock_quantity' => 14, 'alert_threshold' => 4],
            ['name' => 'Toothpaste', 'description' => 'Mint toothpaste tube', 'purchase_price' => 7.00, 'sale_price' => 11.00, 'stock_quantity' => 20, 'alert_threshold' => 5],
            ['name' => 'Soap Pack', 'description' => 'Pack of 4 soap bars', 'purchase_price' => 9.00, 'sale_price' => 14.00, 'stock_quantity' => 12, 'alert_threshold' => 4],
            ['name' => 'Dishwashing Liquid', 'description' => 'Lemon dishwashing liquid', 'purchase_price' => 10.00, 'sale_price' => 15.00, 'stock_quantity' => 11, 'alert_threshold' => 4],
            ['name' => 'Floor Cleaner', 'description' => 'House floor cleaner 1L', 'purchase_price' => 14.00, 'sale_price' => 20.00, 'stock_quantity' => 9, 'alert_threshold' => 3],
            ['name' => 'Glass Cleaner', 'description' => 'Glass and window cleaner spray', 'purchase_price' => 11.00, 'sale_price' => 17.00, 'stock_quantity' => 13, 'alert_threshold' => 4],
            ['name' => 'Paper Towels', 'description' => 'Absorbent kitchen paper towels', 'purchase_price' => 12.00, 'sale_price' => 18.00, 'stock_quantity' => 17, 'alert_threshold' => 5],
            ['name' => 'Hand Sanitizer', 'description' => 'Alcohol-based sanitizer', 'purchase_price' => 8.50, 'sale_price' => 13.00, 'stock_quantity' => 19, 'alert_threshold' => 5],
            ['name' => 'Laundry Detergent', 'description' => 'Liquid detergent 2L', 'purchase_price' => 24.00, 'sale_price' => 34.00, 'stock_quantity' => 8, 'alert_threshold' => 3],
        ];

        foreach ($productsData as $index => $data) {
            $category = $categories[$index % $categories->count()];
            $supplier = $suppliers[$index % $suppliers->count()];

            Product::updateOrCreate(
                ['name' => $data['name']],
                [
                    'description' => $data['description'],
                    'purchase_price' => $data['purchase_price'],
                    'sale_price' => $data['sale_price'],
                    'stock_quantity' => $data['stock_quantity'],
                    'alert_threshold' => $data['alert_threshold'],
                    'category_id' => $category->id,
                    'supplier_id' => $supplier->id,
                    'barcode' => strtoupper(Str::random(12)),
                ]
            );
        }
    }
}