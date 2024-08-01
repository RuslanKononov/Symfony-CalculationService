<?php

declare(strict_types=1);

namespace App\Command;

use App\Command\Factory\TransactionsFactory;
use App\Domain\TransactionCommissionDomain;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class CalculationCommand extends Command
{
    public function __construct(
        private readonly TransactionCommissionDomain $transactionCommissionDomain,
        private readonly TransactionsFactory $factory,
        private readonly string $sharedDirectory,
        string $name = null,
    ) {
        parent::__construct($name);
    }

    protected function configure(): void
    {
        $this->setName('transaction:calculation');
        $this->setDescription('This command calculates commissiones of executed transactions.');
        $this->addArgument('transactions', InputArgument::REQUIRED, 'File of transactions');
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        try {
            $transactionCommissionCollectionDTO = $this->transactionCommissionDomain->calculateTransactionsCommission(
                $this->factory->fileDataToTransactionsCollectionDTO(
                    file_get_contents(
                        sprintf('%2$s/%1$s', $input->getArgument('transactions'), $this->sharedDirectory)
                    )
                )
            );

            $output->writeln(
                $this->factory->transactionCommissionCollectionDTOToResponse($transactionCommissionCollectionDTO)
            );

            return Command::SUCCESS;
        } catch (\Throwable) {
            // @todo implement log of Exceptions
            $output->writeln('Not valid transactions file.');

            return Command::FAILURE;
        }
    }
}
