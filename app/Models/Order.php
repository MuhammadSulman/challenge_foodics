<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Order extends Model
{
    /**
     *
     * @var string
     */
    protected $table = "orders";

    /**
     * @var array
     */
    protected $fillable = [
        'product_id',
        'quantity'
    ];

    /**
     * @var array
     */
    protected $casts = [
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
        'quantity' => 'integer'
    ];

    /**
     * function product
     * 
     * @return BelongsTo
     */
    public function product(): BelongsTo
    {
        return $this
            ->belongsTo(
                Product::class,
                'product_id',
                'id',
                'product'
            );
    }
}
