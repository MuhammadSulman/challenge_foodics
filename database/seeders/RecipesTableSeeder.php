<?php

namespace Database\Seeders;

use App\Models\Ingredient;
use App\Models\Product;
use App\Models\Recipe;
use Illuminate\Database\Seeder;

class RecipesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(): void
    {
        if (Recipe::first()) {
            return;
        }

        $recipes = [
            [
                'title' => 'burger',
                'ingredients' => [
                    'beef' => [
                        'required_amount' => 150,
                        'unit' => 'g'
                    ],
                    'cheese' => [
                        'required_amount' => 30,
                        'unit' => 'g'
                    ],
                    'onion' => [
                        'required_amount' => 20,
                        'unit' => 'g'
                    ]
                ]
            ]
        ];

        ($productQuery = Product::query());

        ($ingredientQuery = Ingredient::query());

        collect($recipes)
            ->each(
                function (array $value) use($productQuery, $ingredientQuery): void {
                    $product = null;

                    if (isset($value['title'])) {
                       $product = (clone $productQuery)
                            ->where('title', $value['title'])
                            ->first();
                    }

                    if (isset($value['ingredients'])) {
                        collect($value['ingredients'])
                            ->each(
                                function (array $record, string $index) use($product, $ingredientQuery): void {
                                    $ingredient = (clone $ingredientQuery)
                                        ->where('title', $index)
                                        ->first();

                                    if ($product && $ingredient) {
                                        $product->ingredients()->attach([$ingredient->id => $record]);
                                    }
                                }
                            );
                    }
                }
            );

    }
}
