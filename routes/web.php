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

$app->get('/', function () use ($app) {
    return $app->version();
});

//PRODUCTS
$app->get('products', 'ProductsController@index');
$app->get('products/{id}', 'ProductsController@show');
$app->put('products/{id}', 'ProductsController@update');
$app->post('products', 'ProductsController@store');
$app->delete('products/{id}', 'ProductsController@destroy');

//ORDERS
$app->get('orders', 'OrdersController@index');
$app->get('orders/{id}', 'OrdersController@show');
$app->put('orders/{id}', 'OrdersController@update');
$app->post('orders', 'OrdersController@store');
$app->delete('orders/{id}', 'OrdersController@destroy');

//CUSTOMERS
$app->get('customers', 'CustomersController@index');
$app->get('customers/{id}', 'CustomersController@show');
$app->put('customers/{id}', 'CustomersController@update');
$app->post('customers', 'CustomersController@store');
$app->delete('customers/{id}', 'CustomersController@destroy');