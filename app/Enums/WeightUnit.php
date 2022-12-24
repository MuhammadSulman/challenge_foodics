<?php

namespace App\Enums;

enum WeightUnit: string
{
    case GRAM = 'g';
    case KILO_GRAM = 'kg';

     /**
     * all static function
     *
     * @return array
     */
    public static function all(): array
    {
        return collect(self::cases())
            ->map(
                function (self $record) {
                    return $record->value;
                }
            )->toArray();
    }
}

