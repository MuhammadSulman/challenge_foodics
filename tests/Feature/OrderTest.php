<?php

namespace Tests\Feature;

use App\Models\Product;
use App\Models\Recipe;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Tests\TestCase;

class OrderTest extends TestCase
{
    use DatabaseMigrations;
    // use RefreshDatabase;

    public function setUp(): void
    {
        parent::setUp();
        // alternatively you can call
        $this->seed();
    }

    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function testStore()
    {
        $response = $this->post('/api/orders', [
            "products" => [
                [
                    "product_id" => 1,
                    "quantity" => 2
                ]
            ]
        ]);

        $response->assertStatus(200);
    }

    public function testStockUpdatedCorrectly()
    {
        $this->post('/api/orders', [
            "products" => [
                [
                    "product_id" => 1,
                    "quantity" => 2
                ]
            ]
        ]);

        $product = Product::first();

        $product->load(
            [
                'recipeIngredients.ingredient'
            ]
        );

        $assertions = [];
        // fetch all ingredients of the product and then add them into the available amount of the ingredients and
        // validate equal to the total_amount.
        $product->recipeIngredients->each(
            function (Recipe $recipe) use(&$assertions) {
                $ingredient = $recipe->ingredient;
                $consumedAmount = ($recipe->required_amount * 2) / 1000;
                // if consumed amount + available amount = total amount, assert true else false
                $assertions[] = ($ingredient->total_amount = ($ingredient->available_amount + $consumedAmount)) ? true : false;
            }
        );

        // if any of the value is false in the assertions array, it mean there is some issue in any of the ingredient's stock update.
        if (in_array(false, $assertions, true)) {
            $this->assertTrue(false);
        }

        $this->assertTrue(true);
    }

}
