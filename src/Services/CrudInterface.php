<?php

namespace MyTasks\Services;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Collection;

interface CrudInterface
{
    /**
     * Lista todos os registros
     *
     * @return \Illuminate\Support\Collection
     */
    public function all(): Collection;

    /**
     * Cria um novo registro
     *
     * @param array $task
     * @return \Illuminate\Database\Eloquent\Model
     */
    public function create(array $task): Model;

    /**
     * Retorna um registro a partir do id
     *
     * @param string $uuid
     * @return \Illuminate\Database\Eloquent\Model
     */
    public function read(string $uuid): Model;

    /**
     * Edita um registro a partir do id
     *
     * @param array $task
     * @param string $uuid
     * @return \Illuminate\Database\Eloquent\Model
     */
    public function update(array $task, string $uuid): Model;

    /**
     * Exclui um registro a partir do id
     *
     * @param string $uuid
     * @return int
     */
    public function delete(string $uuid): int;
}
