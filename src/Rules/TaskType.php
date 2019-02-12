<?php

namespace MyTasks\Rules;

use Illuminate\Contracts\Validation\Rule;

class TaskType implements Rule
{
    /**
     * Determina se a regra de validação é aprovada
     *
     * @param  string  $attribute
     * @param  mixed  $value
     * @return bool
     */
    public function passes($attribute, $value): bool
    {
        return in_array(strtolower($value), ['shopping', 'work']);
    }

    /**
     * Retorna a mensagem de erro da validação
     *
     * @return string
     */
    public function message(): string
    {
        return 'The task type you provided is not supported. You can only use shopping or work.';
    }
}
