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
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return Task::class;
    }

    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }

}
