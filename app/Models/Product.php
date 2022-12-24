<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Product extends Model
{
    /**
     * @var string
     */
    protected $table = "products";

    /**
     * @var array
     */
    protected $fillable = [
        'title'
    ];

    /**
     * @var array
     */
    protected $casts = [
        'created_at' => 'datetime',
        'updated_at' => 'datetime'
    ];

    /**
     * Summary of recipeIngredients
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function recipeIngredients(): HasMany
    {
        return $this
            ->hasMany(
                Recipe::class,
                'product_id',
                'id'
            );
    }

    /**
     * function ingredients
     * @return BelongsToMany
     */
    public function ingredients(): BelongsToMany
    {
        return $this
            ->belongsToMany(
                Ingredient::class,
                app(Recipe::class)->getTable(),
                'product_id',
                'ingredient_id',
                'id',
                'id',
                'ingredients'
            );
    }
}
