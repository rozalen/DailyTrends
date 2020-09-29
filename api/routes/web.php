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

$router->get('/', function () use ($router) {
    return $router->app->version();
});

 /**
 * Feed CRUD controller routes
 */

$router->get('/feed', 'FeedController@index');
$router->get('/feed/{id}', 'FeedController@show');
$router->post('/feed', 'FeedController@store');
$router->put('/feed/{id}', 'FeedController@update');
$router->delete('/feed/{id}', 'FeedController@destroy');

$router->get('/scraping', 'ScrapingController@getNews');
