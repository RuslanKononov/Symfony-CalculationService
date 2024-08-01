<?php

declare(strict_types=1);

namespace App\Enum;

enum CommissionType: string
{
    case EU = '0.01';
    case NON_EU = '0.02';

    public static function getCommissionValue($isEU): string
    {
        return match (true) {
            $isEU => self::EU->value,
            default => self::NON_EU->value,
        };
    }
}
