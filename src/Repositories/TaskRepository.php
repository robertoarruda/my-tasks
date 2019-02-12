<?php

namespace MyTasks\Repositories;

use MyTasks\Models\Task;
use Prettus\Repository\Criteria\RequestCriteria;
use Prettus\Repository\Eloquent\BaseRepository;

class TaskRepository extends BaseRepository
{
    /**
     * Especifica o Model class name
     *
     * @return string
     */
    public function model(): string
    {
        return Task::class;
    }

    /**
     * Inicialize o repositório com os critérios
     *
     * @return void
     */
    public function boot(): void
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }

}
