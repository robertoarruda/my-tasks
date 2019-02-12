<?php

namespace MyTasks\Services;

use ErrorException;
use Exception;
use Illuminate\Support\Collection;
use MyTasks\Models\Task;
use MyTasks\Repositories\TaskRepository;

class TaskService
{
    /**
     * TaskRepository
     *
     * @var \MyTasks\Repositories\TaskRepository
     */
    private $taskRepository;

    public function __construct(TaskRepository $taskRepository)
    {
        $this->taskRepository = $taskRepository;
    }

    /**
     * Lista todas as tarefas
     *
     * @return \Illuminate\Support\Collection
     * @throws \ErrorException
     */
    public function all(): Collection
    {
        return $this->taskRepository->all();
    }

    /**
     * Retorna uma tarefa a partir do id
     *
     * @param string $uuid
     * @return \MyTasks\Models\Task
     */
    public function find(string $uuid): Task
    {
        return $this->taskRepository->find($uuid);
    }

    /**
     * Cria uma nova tarefa
     *
     * @param array $task
     * @return \MyTasks\Models\Task
     */
    public function create(array $task): Task
    {
        return $this->taskRepository->create($task);
    }

    /**
     * Edita uma tarefa a partir do id
     *
     * @param array $task
     * @param string $uuid
     * @return \MyTasks\Models\Task
     */
    public function update(array $task, string $uuid): Task
    {
        return $this->taskRepository->update($task, $uuid);
    }

    /**
     * Exclui uma tarefa a partir do id
     *
     * @param string $uuid
     * @return int
     */
    public function delete(string $uuid): int
    {
        return $this->taskRepository->delete($uuid);
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
            $task = $this->taskRepository->find($uuid);
        } catch (Exception $e) {
            return false;
        }

        return true;
    }
}
