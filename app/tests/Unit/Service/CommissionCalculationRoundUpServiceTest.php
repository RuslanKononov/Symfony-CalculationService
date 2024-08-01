<?php

declare(strict_types=1);

namespace App\Tests\Unit\Service;

use App\Service\CommissionCalculationRoundUpService;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;

class CommissionCalculationRoundUpServiceTest extends KernelTestCase
{
    public function testCalculate(): void
    {
        /** @var CommissionCalculationRoundUpService $commissionCalculationService */
        $commissionCalculationService = self::getContainer()->get(CommissionCalculationRoundUpService::class);

        $comission = $commissionCalculationService->calculate(true, "100");
        $this->assertEquals("1", $comission);

        $comission = $commissionCalculationService->calculate(false, "100");
        $this->assertEquals("2", $comission);

        $comission = $commissionCalculationService->calculate(true, "45.55");
        $this->assertEquals("0.46", $comission);

        $comission = $commissionCalculationService->calculate(false, "45.55");
        $this->assertEquals("0.92", $comission);
    }
}
