<?php

namespace MyTasks\Observers;

use MyTasks\Models\Task;
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
        self::$uuid = Uuid::uuid4();

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
}
