<?php

use Illuminate\Http\Request;


Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});


Route::get('usuario/{id}','Api\ApiController@getUser');
Route::get('usuarios','Api\ApiController@getUsers')->name('getAllUsers');

