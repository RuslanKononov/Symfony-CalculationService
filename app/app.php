<?php

declare(strict_types=1);

if (!isset($argv[1])) {
    exit("No input file with transactions. Please, use: php app.php [filename] for best commission calculation \n");
}

$fileName = $argv[1];
$output = shell_exec(sprintf('php bin/console transaction:calculation %s', $fileName));

echo $output;
