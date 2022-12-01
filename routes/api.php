<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ServiceController;

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

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });

// Route::get('/service/all',['uses' => 'ServiceController@getServiceAll']);
// Route::resource('service', 'ServiceController');

Route::get('/service/all',['uses' => 'ServiceController@getAllService']);
Route::resource('service', 'ServiceController');

// Route::get('/service/all',['uses' => 'ServiceController@getAllService','as' => 'service.getallservice'] );


Route::get('/customer/all',['uses' => 'CustomerController@getCustomerAll']);
Route::resource('customer', 'CustomerController');
Route::post('/customer/{id}',['uses' => 'CustomerController@update']);




Route::get('/employee/all',['uses' => 'EmployeeController@getEmployeeAll']);
Route::resource('employee', 'EmployeeController');
Route::post('/employee/{id}',['uses' => 'EmployeeController@update']);


