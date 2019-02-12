<?php

namespace MyTasks\Console\Commands;

use Illuminate\Console\Command;
use Symfony\Component\Process\Exception\ProcessFailedException;
use Symfony\Component\Process\Process;

class CleanCode extends Command
{
    /**
     * Nome e assinatura do console command
     *
     * @var string
     */
    protected $signature = 'code:check';

    /**
     * Descrição do console command
     *
     * @var string
     */
    protected $description = 'Execute o comando pmd';

    /**
     * Executa o console command
     *
     * @return void
     * @throws Symfony\Component\Process\Exception\ProcessFailedException
     */
    public function handle(): void
    {
        $process = new Process('./vendor/bin/phpmd ./src/ text phpmd.xml');
        $process->run();

        if (!$process->isSuccessful()) {
            throw new ProcessFailedException($process);
        }

        $output = $process->getOutput();

        if (trim($output) === '') {
            $this->info('PHPMD ok');
            return;
        }

        $this->line($output);
    }
}
