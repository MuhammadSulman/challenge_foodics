<?php

namespace Database\Seeders;

use App\Models\Product;
use Illuminate\Database\Seeder;

class ProductsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(): void
    {
        if (Product::first()) {
            return;
        }

        $products = [
            [
                'title' => 'burger'
            ]
        ];

        collect($products)
            ->each(
                function (array $value): void {
                    Product::create($value);
                }
            );
    }
}
