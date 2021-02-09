<?php

// include "../../../Constant.php";

/** @var \Laravel\Lumen\Routing\Router $router */

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

$router->get('api/todo','TodosController@list');
$router->post('api/todo','TodosController@saveTodo');
$router->post('api/todo/done/{id}','TodosController@markAsDone');
$router->delete('api/todo/delete/{id}','TodosController@deleteTodo');



