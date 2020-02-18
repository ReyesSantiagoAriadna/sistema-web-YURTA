<?php

use Illuminate\Http\Request;


Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});



Route::group(['middleware' => ['jwt.verify']], function() {
    Route::get('usuarios','Api\ApiController@usuarios')->name('usuarios');
    Route::get('obras','Api\ApiController@obras')->name('obras');
});



Route::post('login', 'Api\ApiController@authenticate')->name('login');
