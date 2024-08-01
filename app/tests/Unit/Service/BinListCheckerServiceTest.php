<?php

declare(strict_types=1);

namespace App\Tests\Unit\Service;

use App\Service\BinListCheckerService;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;

class BinListCheckerServiceTest extends KernelTestCase
{
    public function testIsEuBin(): void
    {
        $binResults = [
            ['111111', '{"country":{"alpha2":"DK"}}'],
            ['222222', '{"country":{"alpha2":"LT"}}'],
            ['333333', ''],
            ['444444', '{"country":{"alpha2":""}}'],
            ['555555', '{"country":{"alpha2":"UA"}}'],
        ];

        $binListCheckerServiceStub = $this
            ->getMockBuilder(BinListCheckerService::class)
            ->onlyMethods(['getBinResults'])
            ->getMock();

        $binListCheckerServiceStub->method('getBinResults')->willReturnMap($binResults);

        $this->assertTrue($binListCheckerServiceStub->isEuBin('111111'));
        $this->assertTrue($binListCheckerServiceStub->isEuBin('222222'));
        $this->assertFalse($binListCheckerServiceStub->isEuBin('333333'));
        $this->assertFalse($binListCheckerServiceStub->isEuBin('444444'));
        $this->assertFalse($binListCheckerServiceStub->isEuBin('555555'));
    }
}
