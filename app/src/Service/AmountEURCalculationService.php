<?php

declare(strict_types=1);

namespace App\Service;

use BCMathExtended\BC;

class AmountEURCalculationService implements AmountCalculationServiceInterface
{
    private const CURRENCY = 'EUR';

    public function __construct(
        private readonly RateCalculatorServiceInterface $rateCalculatorService,
    ) {
    }

    public function calculate(string $amount, string $currency): string
    {
        return match (true) {
            $currency === self::CURRENCY => $amount,
            default => BC::div($amount, $this->rateCalculatorService->getExchangeRate($currency), 14),
        };
    }
}
