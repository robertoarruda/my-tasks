<?php

namespace MyTasks\Providers;

use Illuminate\Support\ServiceProvider;
use MyTasks\Repositories\TaskRepository;
use MyTasks\Repositories\TaskRepositoryEloquent;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Registra as ligações no container
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(TaskRepository::class, function ($app) {
            return new TaskRepositoryEloquent($app);
        });
    }

}
