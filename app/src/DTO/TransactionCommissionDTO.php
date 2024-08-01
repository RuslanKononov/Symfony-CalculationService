<?php

declare(strict_types=1);

namespace App\DTO;

class TransactionCommissionDTO
{
    public function __construct(
        public readonly string $bin,
        public readonly bool $isEU,
        public readonly string $amountEUR,
        public readonly string $amountCommission,
    ) {
    }
}
