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
$router->get('api/user/{id}','UserApi@getUser');
$router->get('api/me/','UserApi@getMe');

$router->post('api/connect/', 'UserApi@connect');
$router->post('api/register/', 'UserApi@register');
$router->post('api/disconnect/', 'UserApi@disconnect');

$router->get('api/organisation/{orgId}','OrganisationApi@getOrg');
$router->get('api/organisation/{orgId}/members','OrganisationApi@getOrgMembers');
$router->get('api/organisation/{orgId}/admins','OrganisationApi@getOrgAdmins');
$router->post('api/organisation/{orgId}/members','OrganisationApi@addOrgMembers');
$router->post('api/organisation/{orgId}/admins/','OrganisationApi@addOrgAdmin');
$router->post('api/organisation', 'OrganisationApi@createOrg');

$router->get('api/proposition/{id}', 'PropositionApi@getProposition');
$router->post('api/proposition/', 'PropositionApi@createProposition');
$router->get('api/proposition/{id}/tags','PropositionApi@getPropositionTags');
$router->post('api/proposition/{id}/like','PropositionApi@likeProposition');
$router->post('api/proposition/{id}/dislike','PropositionApi@dislikeProposition');
$router->get('api/proposition/{id}/vote','PropositionApi@getVote');
$router->get('api/proposition/organisation/{orgId}', 'PropositionApi@getPropositionByOrgId');

