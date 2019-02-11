<?php

namespace MyTasks\Console\Commands;

use Illuminate\Console\Command;
use Symfony\Component\Process\Exception\ProcessFailedException;
use Symfony\Component\Process\Process;

class AnalyseCode extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'code:analyse';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Executa o phpstan para análise do código';

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $process = new Process('./vendor/bin/phpstan analyse -l 4 -c phpstan.neon ./src');
        $process->run();

        if (!$process->isSuccessful()) {
            throw new ProcessFailedException($process);
        }

        $output = $process->getOutput();

        if (strpos($output, '[OK] No errors') !== false) {
            $this->info('PHPStan ok');
            return;
        }

        $this->line($output);
    }
}
