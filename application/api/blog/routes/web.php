<?php

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
$router->get('/', function () {
    return 'Hello World';
});
$router->get('api/todo','TodosApi@list');
$router->post('api/todo','TodosApi@saveTodo');
$router->post('api/todo/done/{id}','TodosApi@markAsDone');
$router->delete('api/todo/delete/{id}','TodosApi@deleteTodo');

$router->get('api/user/{id}','UserApi@getUser');
$router->get('api/me/','UserApi@getMe');

$router->post('api/connect/', 'UserApi@connect');
$router->post('api/register/', 'UserApi@register');
$router->post('api/disconnect/', 'UserApi@disconnect');

$router->get('api/organisation/{id}','OrganisationApi@getOrg');
$router->get('api/organisation/{orgId}/members','OrganisationApi@getOrgMembers');
