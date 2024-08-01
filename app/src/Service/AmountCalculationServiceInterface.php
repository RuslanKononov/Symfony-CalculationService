<?php

declare(strict_types=1);

namespace App\Service;

interface AmountCalculationServiceInterface
{
    public function calculate(string $amount, string $currency): string;
}
