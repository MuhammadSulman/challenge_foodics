<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Marchant extends Model
{
    /**
     * @var array
     */
    protected $table = "marchants";

    /**
     * function user
     * @return BelongsTo
     */
    public function user(): BelongsTo
    {
        return $this
            ->belongsTo(
                User::class,
                'user_id',
                'id'
            );
    }
}
