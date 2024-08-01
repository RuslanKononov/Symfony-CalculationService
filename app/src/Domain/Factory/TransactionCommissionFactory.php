<?php

declare(strict_types=1);

namespace App\Domain\Factory;

use App\DTO\TransactionCommissionCollectionDTO;

class TransactionCommissionFactory
{
    public function createTransactionCommissionCollectionDTO(): TransactionCommissionCollectionDTO
    {
        return new TransactionCommissionCollectionDTO();
    }
}
