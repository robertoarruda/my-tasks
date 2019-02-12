<?php

namespace MyTasks\Exceptions;

use Exception;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Validation\ValidationException;
use Laravel\Lumen\Exceptions\Handler as ExceptionHandler;
use Symfony\Component\HttpKernel\Exception\HttpException;

class Handler extends ExceptionHandler
{
    /**
     * Lista dos tipos de exceção que não devem ser relatados
     *
     * @var array
     */
    protected $dontReport = [
        AuthorizationException::class,
        HttpException::class,
        ModelNotFoundException::class,
        ValidationException::class,
    ];

    /**
     * Informar ou registrar uma exceção
     *
     * @param  \Exception  $exception
     * @return void
     */
    public function report(Exception $exception): void
    {
        parent::report($exception);
    }

    /**
     * Renderizar uma exceção em uma resposta HTTP
     *
     * @param \Illuminate\Http\Request $request
     * @param \Exception $exception
     * @return \Illuminate\Http\Response
     */
    public function render($request, Exception $exception)
    {
        if (!$this->shouldReport($exception)) {
            return parent::render($request, $exception);
        }

        $response = ['message' => $exception->getMessage()];

        return response()->json($response, $exception->getCode() ?: 500);
    }
}
