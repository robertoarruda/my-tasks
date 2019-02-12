<?php

namespace MyTasks\Http\Requests;

use MyTasks\Rules\TaskType;
use Pearl\RequestValidate\RequestAbstract;

class Task extends RequestAbstract
{
    /**
     * Determina se o usuário está autorizado a fazer essa solicitação
     *
     * @return bool
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Retorna as regras de validação que se aplicam à solicitação
     *
     * @return array
     */
    public function rules(): array
    {
        return [
            'type' => new TaskType,
            'content' => 'required',
            'sort_order' => 'sometimes|int|min:1',
            'done' => 'sometimes|boolean',
        ];
    }

    /**
     * Retorna as mensagens personalizadas para erros do validador
     *
     * @return array
     */
    public function messages(): array
    {
        return [
            'content.required' => 'Bad move! Try removing the task instead of deleting its content.',
        ];
    }
}
