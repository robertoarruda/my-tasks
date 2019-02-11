<?php

namespace MyTasks\Models;

use Illuminate\Database\Eloquent\Model;
use MyTasks\Traits\Uuid;
use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;

class Task extends Model implements Transformable
{
    use Uuid;
    use TransformableTrait;

    /**
     * Define o campo "created at"
     *
     * @var string
     */
    const CREATED_AT = 'date_created';

    /**
     * Define o campo "updated at"
     *
     * @var string
     */
    const UPDATED_AT = 'date_updated';

    /**
     * Define a primary key do model
     *
     * @var string
     */
    protected $primaryKey = 'uuid';

    /**
     * Define os atributos que são atribuíveis em massa
     *
     * @var array
     */
    protected $fillable = [
        'type',
        'content',
        'sort_order',
        'done',
    ];

    /**
     * Define os atributos que devem ser convertidos em tipos nativos
     *
     * @var array
     */
    protected $casts = [
        'uuid' => 'string',
        'type' => 'string',
        'content' => 'text',
        'sort_order' => 'integer',
        'done' => 'boolean',
    ];
}
