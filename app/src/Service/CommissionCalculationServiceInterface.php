<?php

declare(strict_types=1);

namespace App\Service;

interface CommissionCalculationServiceInterface
{
    public function calculate(bool $isEU, string $amountEUR): string;
}
