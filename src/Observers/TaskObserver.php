<?php

namespace MyTasks\Observers;

use MyTasks\Models\Task;
use MyTasks\Services\TaskService;
use Ramsey\Uuid\Uuid;

class TaskObserver
{
    /**
     * Guarda o valor do uuid
     *
     * @var string
     */
    private static $uuid;

    /**
     * Manipula o evento "creating" da task.
     *
     * @param  \MyTasks\Models\Task  $task
     * @return void
     */
    public function creating(Task $task): void
    {
        self::$uuid = Uuid::uuid4()->toString();

        $task->uuid = self::$uuid;
    }

    /**
     * Manipula o evento "created" da task.
     *
     * @param  \MyTasks\Models\Task  $task
     * @return void
     */
    public function created(Task $task): void
    {
        $task->uuid = self::$uuid;

        self::$uuid = '';
    }

    /**
     * Manipula o evento "saved" da task.
     *
     * @param  \MyTasks\Models\Task  $task
     * @return void
     */
    public function saved(Task $task): void
    {
        app(TaskService::class)->reorder($task, 'increment');
    }

    /**
     * Manipula o evento "saved" da task.
     *
     * @param  \MyTasks\Models\Task  $task
     * @return void
     */
    public function deleted(Task $task): void
    {
        app(TaskService::class)->reorder($task, 'decrement');
    }
}
