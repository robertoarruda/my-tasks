<?php

namespace MyTasks\Console\Commands;

use Illuminate\Console\Command;
use Symfony\Component\Process\Exception\ProcessFailedException;
use Symfony\Component\Process\Process;

class CleanCode extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'code:check';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Execute o comando pmd';

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
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
