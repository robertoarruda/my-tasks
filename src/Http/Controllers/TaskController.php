<?php

namespace MyTasks\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;
use MyTasks\Models\Task;
use MyTasks\Services\TaskService;

class TaskController extends Controller
{
    /**
     * Lista todas as tarefas
     *
     * @param \MyTasks\Services\TaskService $service
     * @return \Illuminate\Support\Collection
     */
    public function index(TaskService $service): Collection
    {
        return $service->all();
    }

    /**
     * Retorna um tarefa a partir do id
     *
     * @param \MyTasks\Services\TaskService $service
     * @param string $uuid
     * @return \MyTasks\Models\Task
     */
    public function view(TaskService $service, string $uuid): Task
    {
        return $service->find($uuid);
    }

    /**
     * Cria e retorna uma nova tarefa
     *
     * @param \Illuminate\Http\Request $request
     * @param \MyTasks\Services\TaskService $service
     * @return \MyTasks\Models\Task
     */
    public function create(Request $request, TaskService $service): Task
    {
        return $service->create($request->all());
    }

    /**
     * Edita e retorna uma tarefa a partir do id
     *
     * @param \Illuminate\Http\Request $request
     * @param \MyTasks\Services\TaskService $service
     * @param string $uuid
     * @return \MyTasks\Models\Task
     */
    public function edit(Request $request, TaskService $service, string $uuid): Task
    {
        return $service->update($request->all(), $uuid);
    }

    /**
     * Exclui um tarefa a partir do id
     *
     * @param \MyTasks\Services\TaskService $service
     * @param string $uuid
     * @return bool
     */
    public function delete(TaskService $service, string $uuid): bool
    {
        return $service->delete($uuid);
    }

}
