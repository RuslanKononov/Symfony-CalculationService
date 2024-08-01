<?php

declare(strict_types=1);

namespace App\Service;

use App\Enum\CommissionType;
use BCMathExtended\BC;

class CommissionCalculationRoundUpService implements CommissionCalculationServiceInterface
{
    public function calculate(bool $isEU, string $amountEUR): string
    {
        return BC::roundUp(bcmul(CommissionType::getCommissionValue($isEU), $amountEUR, 14), 2);
    }
}
