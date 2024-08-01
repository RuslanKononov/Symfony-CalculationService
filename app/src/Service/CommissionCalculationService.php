<?php

declare(strict_types=1);

namespace App\Service;

use App\Enum\CommissionType;
use BCMathExtended\BC;

class CommissionCalculationService implements CommissionCalculationServiceInterface
{
    public function calculate(bool $isEU, string $amountEUR): string
    {
        return BC::mul(CommissionType::getCommissionValue($isEU), $amountEUR, 14);
    }
}
