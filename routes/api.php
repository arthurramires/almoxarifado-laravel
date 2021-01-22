<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/
Route::post('products', 'ProductsController@register');
Route::get('products', 'ProductsController@index');
Route::put('products/{id}', 'ProductsController@update');

Route::post('customers', 'CustomersController@register');
Route::get('warehouses', 'WarehousesController@index');

Route::post('purchases', 'PurchasesController@register');
Route::get('purchases', 'PurchasesController@index');

Route::post('sales', 'SalesController@register');
Route::get('sales', 'SalesController@index');





