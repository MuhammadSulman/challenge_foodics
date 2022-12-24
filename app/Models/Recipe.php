<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\Pivot;

class Recipe extends Pivot
{
    /**
     * @var string
     */
    protected $table = "recipes";

    /**
     * @var array
     */
    protected $fillable = [
        'required_amount',
        'unit'
    ];

    /**
     * @var array
     */
    protected $casts = [
        'required_amount' => 'double'
    ];

    /**
     * function ingredient
     * @return BelongsTo
     */
    public function ingredient(): BelongsTo
    {
        return $this
            ->belongsTo(
                Ingredient::class,
                'ingredient_id',
                'id'
            );
    }
}
