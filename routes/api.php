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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

//Route::resource('posts', 'Api\PostController')->except(['create', 'edit']);
/*dentro de excep colocamos los metodos que no vamos a utilizar, si ponemos only en lugar de 
except, le estariamos diciendo que va a utilizar esos 2 unicos metodos*/

Route::apiResource('posts', 'Api\PostController'); //con apiResource solo va a crear los metodos que contiene un api
Route::apiResource('user', 'Api\AuthController');

