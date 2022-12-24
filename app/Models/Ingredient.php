<?php

namespace App\Models;

use App\Enums\WeightUnit;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Ingredient extends Model
{
    public const PERCENTAGE_THRESHOLD = 50;
    
    /**
     * @var string
     */
    protected $table = "ingredients";

    /**
     * @var array
     */
    protected $fillable = [
        'title',
        'total_amount',
        'available_amount',
        'marchant_id',
        'unit',
        'is_notified'
    ];

    /**
     * @var array
     */
    protected $casts = [
        'total_amount' => 'double',
        'available_amount' => 'double',
        'unit' => WeightUnit::class,
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
        'is_notified' => 'boolean'
    ];

    /**
     * function marchant
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function marchant(): BelongsTo
    {
        return $this
            ->belongsTo(
                Marchant::class,
                'marchant_id',
                'id'
            );
    }
}
