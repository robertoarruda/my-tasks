<?php

namespace MyTasks\Traits;

use Illuminate\Database\Eloquent\Model;
use Ramsey\Uuid\Uuid as Ramsey;

trait Uuid
{
    public static function bootUuid()
    {
        static::creating(function (Model $model) {
            $model->uuid = Ramsey::uuid4();
        });
    }
}
