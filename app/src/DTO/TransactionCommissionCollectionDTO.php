<?php

declare(strict_types=1);

namespace App\DTO;

class TransactionCommissionCollectionDTO
{
    private $transactions;
    public function addTransaction(TransactionCommissionDTO $transaction): void
    {
        $this->transactions[] = $transaction;
    }

    /**
     * @return array | TransactionCommissionDTO[]
     */
    public function getTransactions(): array
    {
        return $this->transactions;
    }
}
