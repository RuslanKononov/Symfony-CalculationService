<?php

declare(strict_types=1);

namespace App\DTO;

class TransactionDTO
{
    public function __construct(
        public readonly string $bin,
        public readonly string $amount,
        public readonly string $currency,
    ) {
    }
}
