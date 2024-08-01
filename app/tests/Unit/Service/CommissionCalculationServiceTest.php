<?php

declare(strict_types=1);

namespace App\Tests\Unit\Service;

use App\Service\CommissionCalculationService;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;

class CommissionCalculationServiceTest extends KernelTestCase
{
    public function testCalculate(): void
    {
        /** @var CommissionCalculationService $commissionCalculationService */
        $commissionCalculationService = self::getContainer()->get(CommissionCalculationService::class);

        $comission = $commissionCalculationService->calculate(true, "100");
        $this->assertEquals("1", $comission);

        $comission = $commissionCalculationService->calculate(false, "100");
        $this->assertEquals("2", $comission);

        $comission = $commissionCalculationService->calculate(true, "45.55");
        $this->assertEquals("0.4555", $comission);

        $comission = $commissionCalculationService->calculate(false, "45.55");
        $this->assertEquals("0.911", $comission);
    }
}
