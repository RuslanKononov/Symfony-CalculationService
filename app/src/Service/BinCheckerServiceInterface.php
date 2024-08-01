<?php

declare(strict_types=1);

namespace App\Service;

interface BinCheckerServiceInterface
{
    public function isEuBin(string $bin): bool;
}
