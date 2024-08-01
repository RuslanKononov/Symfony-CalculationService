<?php

declare(strict_types=1);

namespace App\Tests\Unit\Service;

use App\Service\AmountEURCalculationService;
use App\Service\ExchangeRatesCalculatorService;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;

class AmountEURCalculationServiceTest extends KernelTestCase
{
    public function testCalculate(): void
    {
        $exchangeRates = [
            ['USD', '1.08'],
            ['GBP', '0.83'],
        ];

        $exchangeRatesCalculatorService = $this->createMock(ExchangeRatesCalculatorService::class);
        $exchangeRatesCalculatorService->method('getExchangeRate')->willReturnMap($exchangeRates);

        self::getContainer()->set(ExchangeRatesCalculatorService::class, $exchangeRatesCalculatorService);

        $amountEURCalculationService = self::getContainer()->get(AmountEURCalculationService::class);

        $this->assertEquals($amountEURCalculationService->calculate('108', 'USD'), '100');
        $this->assertEquals($amountEURCalculationService->calculate('100', 'EUR'), '100');
        $this->assertEquals($amountEURCalculationService->calculate('83', 'GBP'), '100');
    }
}
