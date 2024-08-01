<?php

declare(strict_types=1);

namespace App\Service;

class ExchangeRatesCalculatorService implements RateCalculatorServiceInterface
{
    const string URL = 'http://api.exchangeratesapi.io/latest';
    const int DEFAULT_RATE = 1;

    public function __construct(
        private readonly string $apiKey,
    ) {
    }

    public function getExchangeRate(string $currency): string
    {
        // @todo optimize count of requests with caching because of similar response from service
        $url = sprintf('%1$s?access_key=%2$s', self::URL, $this->apiKey);

        return (string)((json_decode(file_get_contents($url)))?->rates?->$currency ?? self::DEFAULT_RATE);
    }
}
