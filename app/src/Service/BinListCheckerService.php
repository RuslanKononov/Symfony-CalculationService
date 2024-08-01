<?php

declare(strict_types=1);

namespace App\Service;

use App\Service\Exception\BinCheckerNoResultsException;

class BinListCheckerService implements BinCheckerServiceInterface
{
    private const URL = 'https://lookup.binlist.net/';

    public function isEuBin(string $bin): bool
    {
        try {
            $binResults = $this->getBinResults($bin);

            $binCountry = (json_decode($binResults))?->country?->alpha2;
        } catch (BinCheckerNoResultsException $e) {
        } catch (\Throwable $e) {
            // @todo log exception

            // In case of empty data about bin or error on lookup.binlist.net we'll calculate NON_EU commission
            return false;
        }

        return $this->isEUCountryChecker((string)$binCountry);
    }

    protected function getBinResults(string $bin): string
    {
        $binResults = file_get_contents(self::URL . $bin);
        if (!$binResults) {
            throw new BinCheckerNoResultsException(
                sprintf('No results found for bin: %1$s. Probably, problem with %2$s \n', $bin, self::URL)
            );
        }

        return $binResults;
    }
    private function isEUCountryChecker(string $country): bool
    {
        return match ($country) {
            'AT', 'BE', 'BG', 'CY', 'CZ', 'DE', 'DK', 'EE', 'ES', 'FI', 'FR', 'GR', 'HR', 'HU',
            'IE', 'IT', 'LT', 'LU', 'LV', 'MT', 'NL', 'PO', 'PT', 'RO', 'SE', 'SI', 'SK' => true,
            default => false,
        };
    }
}
