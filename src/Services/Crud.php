<?php

namespace MyTasks\Services;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Collection;

trait Crud
{
    /**
     * Lista todos os registros
     *
     * @return \Illuminate\Support\Collection
     */
    public function all(): Collection
    {
        return $this->repository
            ->orderBy('sort_order')
            ->all();
    }

    /**
     * Cria um novo registro
     *
     * @param array $task
     * @return \Illuminate\Database\Eloquent\Model
     */
    public function create(array $task): Model
    {
        return $this->repository->create($task);
    }

    /**
     * Retorna um registro a partir do id
     *
     * @param string $uuid
     * @return \Illuminate\Database\Eloquent\Model
     */
    public function read(string $uuid): Model
    {
        return $this->repository->find($uuid);
    }

    /**
     * Edita um registro a partir do id
     *
     * @param array $task
     * @param string $uuid
     * @return \Illuminate\Database\Eloquent\Model
     */
    public function update(array $task, string $uuid): Model
    {
        return $this->repository->update($task, $uuid);
    }

    /**
     * Exclui um registro a partir do id
     *
     * @param string $uuid
     * @return int
     */
    public function delete(string $uuid): int
    {
        return $this->repository->delete($uuid);
    }
}
