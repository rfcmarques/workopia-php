<?php

$router->get('/', 'HomeController@index');

$router->get('/listings', 'ListingController@index');
$router->post('/listings', 'ListingController@store');
$router->get('/listings/create', 'ListingController@create');
$router->get('/listings/{id}', 'ListingController@show');
$router->get('/listings/edit/{id}', 'ListingController@edit');
$router->put('/listings/{id}', 'ListingController@update');
$router->delete('/listings/{id}', 'ListingController@destroy');

$router->get('/auth/register', 'UserController@create');
$router->post('/auth/register', 'UserController@store');
$router->get('/auth/login', 'UserController@login');
$router->post('/auth/login', 'UserController@authenticate');
$router->post('/auth/logout', 'UserController@logout');
