<?php

namespace Database\Seeders;

use App\Enums\WeightUnit;
use App\Models\Ingredient;
use App\Models\Marchant;
use Illuminate\Database\Seeder;

class IngredientsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(): void
    {
        if (Ingredient::first()) {
            return;
        }

        $ingredients = [
            [
                'title' => 'beef',
                'total_amount' => 20,
                'available_amount' => 20,
            ],
            [
                'title' => 'cheese',
                'total_amount' => 5,
                'available_amount' => 5,
            ],
            [
                'title' => 'onion',
                'total_amount' => 1,
                'available_amount' => 1,
            ]
        ];

        $marchant = Marchant::inRandomOrder()
            ->limit(1)
            ->first();

        collect($ingredients)
            ->each(
                function (array $record) use($marchant): void {
                    Ingredient::create(
                        array_merge(
                           $record,
                           [
                                'marchant_id' => $marchant->id,
                                'unit' => WeightUnit::KILO_GRAM
                           ]
                        )
                    );
                }
            );
    }
}
