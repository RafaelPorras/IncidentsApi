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

$router->get('/incidents','IncidentController@index');
$router->post('/incidents','IncidentController@store');
$router->get('/incidents/{incident}','IncidentController@show');
$router->put('/incidents/{incident}','IncidentController@update');
$router->patch('/incidents/{incident}','IncidentController@update');
$router->delete('/incidents/{incident}','IncidentController@destroy');