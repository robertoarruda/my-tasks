<?php

namespace MyTasks\Providers;

use Illuminate\Support\ServiceProvider;
use MyTasks\Models\Task;
use MyTasks\Observers\TaskObserver;
use MyTasks\Repositories\TaskRepository;
use MyTasks\Repositories\TaskRepositoryEloquent;

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

    /**
     * Registra as ligações no container
     *
     * @return void
     */
    public function register(): void
    {
        $this->app->bind(TaskRepository::class, function ($app) {
            return new TaskRepositoryEloquent($app);
        });
    }

}
