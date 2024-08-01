<?php

declare(strict_types=1);

namespace App\BusinessCase;

use App\DTO\TransactionCommissionDTO;
use App\DTO\TransactionDTO;
use App\Service\AmountCalculationServiceInterface;
use App\Service\BinCheckerServiceInterface;
use App\Service\CommissionCalculationServiceInterface;

class CalculateCommissionBusinessCase
{
    public function __construct(
        private readonly BinCheckerServiceInterface $binCheckerService,
        private readonly AmountCalculationServiceInterface $amountCalculationService,
        private readonly CommissionCalculationServiceInterface $commissionCalculationService,
    ) {
    }

    public function calculate(TransactionDTO $transactionDTO): TransactionCommissionDTO {
        $isEU = $this->binCheckerService->isEuBin($transactionDTO->bin);

        $amountEUR = $this->amountCalculationService->calculate($transactionDTO->amount, $transactionDTO->currency);

        $amountCommission = $this->commissionCalculationService->calculate($isEU, $amountEUR);

        return new TransactionCommissionDTO(
            $transactionDTO->bin,
            $isEU,
            $amountEUR,
            $amountCommission,
        );
    }
}
