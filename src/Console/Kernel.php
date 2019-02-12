<?php

namespace MyTasks\Console;

use Laravel\Lumen\Console\Kernel as ConsoleKernel;

class Kernel extends ConsoleKernel
{
    /**
     * Os comandos do Artisan fornecidos pelo seu aplicativo.
     *
     * @var array
     */
    protected $commands = [
        Commands\CleanCode::class,
        Commands\FixCode::class,
        Commands\AnalyseCode::class,
    ];

}
