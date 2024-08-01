<?php

declare(strict_types=1);

namespace App\Domain;

use App\BusinessCase\CalculateCommissionBusinessCase;
use App\Domain\Factory\TransactionCommissionFactory;
use App\DTO\TransactionCollectionDTO;
use App\DTO\TransactionCommissionCollectionDTO;

class TransactionCommissionDomain
{
    public function __construct(
        private readonly CalculateCommissionBusinessCase $calculateCommissionBusinessCase,
        private TransactionCommissionFactory $factory,
    ) {
    }

    public function calculateTransactionsCommission(
        TransactionCollectionDTO $transactionCollectionDTO
    ): TransactionCommissionCollectionDTO {
        $transactionComissionCollectionDTO = $this->factory->createTransactionCommissionCollectionDTO();

        foreach ($transactionCollectionDTO->getTransactions() as $transactionDTO) {
            $transactionComissionCollectionDTO->addTransaction(
                $this->calculateCommissionBusinessCase->calculate($transactionDTO)
            );

            // Temporary workaround solution to resolve issue with "Too many requests" via free API BIN checker
            // Until we use free plan subscription
            sleep(5);
        }

        return $transactionComissionCollectionDTO;
    }
}
