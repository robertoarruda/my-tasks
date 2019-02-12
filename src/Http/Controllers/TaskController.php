<?php

namespace MyTasks\Http\Controllers;

use App\Http\Controllers\Controller;
use ErrorException;
use Illuminate\Support\Collection;
use MyTasks\Http\Requests\Task as TaskRequests;
use MyTasks\Models\Task;
use MyTasks\Services\TaskService;

class TaskController extends Controller
{
    /**
     * Lista todas as tarefas
     *
     * @param \MyTasks\Services\TaskService $service
     * @return \Illuminate\Support\Collection
     * @throws \ErrorException
     */
    public function index(TaskService $service): Collection
    {
        $tasks = $service->all();
        if ($tasks->isEmpty()) {
            throw new ErrorException('Wow. You have nothing else to do. Enjoy the rest of your day!', 202);
        }

        return $tasks;
    }

    /**
     * Retorna um tarefa a partir do id
     *
     * @param \MyTasks\Services\TaskService $service
     * @param string $uuid
     * @return \MyTasks\Models\Task
     * @throws \ErrorException
     */
    public function view(TaskService $service, string $uuid): Task
    {
        if (!$service->checkUuid($uuid)) {
            throw new ErrorException('Are you a hacker or something? The task you were trying to get doesn\'t exist.', 400);
        }

        return $service->find($uuid);
    }

    /**
     * Cria e retorna uma nova tarefa
     *
     * @param \MyTasks\Http\Requests\Task $request
     * @param \MyTasks\Services\TaskService $service
     * @return \MyTasks\Models\Task
     */
    public function create(TaskRequests $request, TaskService $service): Task
    {
        return $service->create($request->all());
    }

    /**
     * Edita e retorna uma tarefa a partir do id
     *
     * @param \MyTasks\Http\Requests\Task $request
     * @param \MyTasks\Services\TaskService $service
     * @param string $uuid
     * @return \MyTasks\Models\Task
     * @throws \ErrorException
     */
    public function edit(TaskRequests $request, TaskService $service, string $uuid): Task
    {
        if (!$service->checkUuid($uuid)) {
            throw new ErrorException('Are you a hacker or something? The task you were trying to edit doesn\'t exist.', 400);
        }

        return $service->update($request->all(), $uuid);
    }

    /**
     * Exclui um tarefa a partir do id
     *
     * @param \MyTasks\Services\TaskService $service
     * @param string $uuid
     * @return string
     * @throws \ErrorException
     */
    public function delete(TaskService $service, string $uuid): string
    {
        if (!$service->checkUuid($uuid)) {
            throw new ErrorException('Good news! The task you were trying to delete didn\'t even exist.', 400);
        }

        return (string) $service->delete($uuid);
    }

}
