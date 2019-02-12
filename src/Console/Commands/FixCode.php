<?php

namespace MyTasks\Console\Commands;

use Illuminate\Console\Command;
use Symfony\Component\Process\Exception\ProcessFailedException;
use Symfony\Component\Process\Process;

class FixCode extends Command
{
    /**
     * Nome e assinatura do console command
     *
     * @var string
     */
    protected $signature = 'code:fix';

    /**
     * Descrição do console command
     *
     * @var string
     */
    protected $description = 'Fixa o código no padrão PSR-2';

    /**
     * Executa o console command
     *
     * @return void
     * @throws Symfony\Component\Process\Exception\ProcessFailedException
     */
    public function handle(): void
    {
        $process = new Process('./vendor/bin/php-cs-fixer fix ./src');
        $process->run();

        if (!$process->isSuccessful()) {
            throw new ProcessFailedException($process);
        }

        $output = $process->getOutput();

        if (strpos($output, 'Fixed all files') !== false) {
            $this->info('PSR-2 ok');
            return;
        }

        $this->line($output);
    }
}
