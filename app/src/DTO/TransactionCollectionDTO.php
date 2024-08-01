<?php

declare(strict_types=1);

namespace App\DTO;

class TransactionCollectionDTO
{
    private $transactions;
    public function addTransaction(TransactionDTO $transaction): void
    {
        $this->transactions[] = $transaction;
    }

    /**
     * @return array | TransactionDTO[]
     */
    public function getTransactions(): array
    {
        return $this->transactions;
    }
}
