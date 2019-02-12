<?php

namespace MyTasks\Providers;

use Illuminate\Support\ServiceProvider;
use MyTasks\Models\Task;
use MyTasks\Observers\TaskObserver;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Inicialize todos os serviços de aplicativos
     *
     * @return void
     */
    public function boot(): void
    {
        Task::observe(TaskObserver::class);
    }

}
