<?php

namespace MyTasks\Services;

use Exception;
use MyTasks\Models\Task;
use MyTasks\Repositories\TaskRepository;
use MyTasks\Services\CrudInterface;

class TaskService implements CrudInterface
{
    use Crud;

    /**
     * TaskRepository
     *
     * @var \MyTasks\Repositories\TaskRepository
     */
    private $repository;

    public function __construct(TaskRepository $repository)
    {
        $this->repository = $repository;
    }

    /**
     * Verifica se o uuid existe
     *
     * @param string $uuid
     * @return bool
     */
    public function checkUuid(string $uuid): bool
    {
        try {
            $task = $this->repository->find($uuid);
        } catch (Exception $exception) {
            return false;
        }

        return true;
    }

    /**
     * Reordena os registro pelo campo sort_order
     *
     * @param \MyTasks\Models\Task $task
     * @param string $action
     * @return void
     */
    public function reorder(Task $task, string $action): void
    {
        $tasks = $this->repository
            ->orderBy('sort_order')
            ->findWhere(
                [
                    ['uuid', '<>', $task->uuid],
                    ['sort_order', '>=', $task->sort_order],
                ]
            );

        foreach ($tasks as $task) {
            $task->$action('sort_order');
        }
    }

    /**
     * Reordena os registro do intervalo pelo campo sort_order
     *
     * @param \MyTasks\Models\Task $task
     * @param int $oldSortOrder
     * @return void
     */
    public function reorderInterval(Task $task, int $oldSortOrder): void
    {
        $between = [$task->sort_order, $oldSortOrder];
        asort($between);

        $tasks = $this->repository->makeModel()
            ->orderBy('sort_order')
            ->where('uuid', '<>', $task->uuid)
            ->whereBetween('sort_order', $between)
            ->get();

        $action = ($task->sort_order < $oldSortOrder) ? 'increment' : 'decrement';

        foreach ($tasks as $task) {
            $task->$action('sort_order');
        }
    }
}
