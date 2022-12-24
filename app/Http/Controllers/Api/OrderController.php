<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\OrderRequest;
use App\Models\Ingredient;
use App\Models\Order;
use App\Models\Recipe;
use App\Notifications\MarchantNotification;

class OrderController extends Controller
{
    /**
     * function store
     * @param OrderRequest $request
     * @return void
     */
    public function store(OrderRequest $request): void
    {
        $payload = $request->validated();

        collect($payload['products'])
            ->each(
                function (array $value) {
                    $order = Order::create($value);

                    $order->load(
                        [
                            'product.recipeIngredients.ingredient'
                        ]
                    );

                    $quantity = $order->quantity;

                    $product = $order->product;

                    $product->recipeIngredients->each(
                        function (Recipe $recipe) use($quantity): void {
                            $orderedAmount = $recipe->required_amount * $quantity;
                            $ingredient = $recipe->ingredient;

                            // multiplication with 1000 to just convert the kg into grams.
                            $availableAmount = (($ingredient->available_amount * 1000) - $orderedAmount) / 1000;
                            $percentage = ($availableAmount * 1000 * 100) / ($ingredient->total_amount * 1000);

                            $payload = [
                                'available_amount' => $availableAmount
                            ];

                            // validate the percentage threshold and the email has not been sent yet.
                            if ($percentage <= Ingredient::PERCENTAGE_THRESHOLD && !$ingredient->is_notified) {
                                $ingredient->marchant->user->notify(new MarchantNotification($ingredient->title));
                                $payload['is_notified'] = true;
                            }

                            $ingredient->fill($payload);
                            $ingredient->save();
                        }
                    );
                }
            );
    }
}
