<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It is a breeze. Simply tell Lumen the URIs it should respond to
| and give it the Closure to call when that URI is requested.
|
 */

$router->get('/', function () use ($router) {
    return $router->app->version();
});

$router->group(['prefix' => 'task'], function () use ($router) {

    $router
        ->get('/', ['uses' => 'TaskController@index', 'as' => 'index'])
        ->get('/{taskId}', ['uses' => 'TaskController@view', 'as' => 'view'])
        ->post('/', ['uses' => 'TaskController@create', 'as' => 'create'])
        ->put('/{taskId}', ['uses' => 'TaskController@edit', 'as' => 'edit'])
        ->delete('/{taskId}', ['uses' => 'TaskController@delete', 'as' => 'delete']);
});
