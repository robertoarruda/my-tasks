<?php

namespace MyTasks\Repositories;

use MyTasks\Models\Task;
use MyTasks\Repositories\TaskRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use Prettus\Repository\Eloquent\BaseRepository;

/**
 * Class TaskRepositoryEloquent.
 *
 * @package namespace MyTasks\Repositories;
 */
class TaskRepositoryEloquent extends BaseRepository implements TaskRepository
{
    /**
     * Especifica a Model class name
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
