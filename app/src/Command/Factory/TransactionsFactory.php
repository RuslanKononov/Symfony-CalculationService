<?php

declare(strict_types=1);

namespace App\Command\Factory;

use App\DTO\TransactionCollectionDTO;
use App\DTO\TransactionCommissionCollectionDTO;
use App\DTO\TransactionDTO;

class TransactionsFactory
{
    public function fileDataToTransactionsCollectionDTO(string $fileData): TransactionCollectionDTO
    {
        $transactions = new TransactionCollectionDTO();
        foreach (explode("\n", $fileData) as $row) {
            try {
                $transaction = json_decode($row, false, 512, JSON_THROW_ON_ERROR);
                if (!isset($transaction, $transaction->bin, $transaction->amount, $transaction->currency)) {
                    continue;
                }

                $transactionDTO = new TransactionDTO(
                    bin: $transaction->bin,
                    amount: $transaction->amount,
                    currency: $transaction->currency,
                );
                $transactions->addTransaction($transactionDTO);
            } catch (\Exception $e) {
                // @todo log error message if some file data was failed
            }
        }

        return $transactions;
    }

    public function transactionCommissionCollectionDTOToResponse(
        TransactionCommissionCollectionDTO $transactionCommissionCollectionDTO,
    ): string {
        $responseArray = [];

        foreach ($transactionCommissionCollectionDTO->getTransactions() as $transactionCommissionDTO) {
            $responseArray[] = $transactionCommissionDTO->amountCommission;
        }

        return implode("\n", $responseArray);
    }
}
