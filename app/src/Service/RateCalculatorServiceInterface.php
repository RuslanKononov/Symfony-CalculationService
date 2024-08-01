<?php

declare(strict_types=1);

namespace App\Service;

interface RateCalculatorServiceInterface
{
    public function getExchangeRate(string $currency): string;
}
