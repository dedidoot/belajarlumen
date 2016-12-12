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

$app->get('/vouchers/{code}', 'VouchersController@getByCodeVoucher');

$app->post('/vouchers', 'VouchersController@insert');

$app->get('/vouchers', 'VouchersController@getAll');

$app->post('/vouchers/update', 'VouchersController@update');

$app->post('/vouchers/delete', 'VouchersController@delete');

$app->post('/vouchers/upload', 'VouchersController@uploadImage');
