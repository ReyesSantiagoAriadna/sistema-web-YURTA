<?php

use Illuminate\Http\Request;


Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});



Route::group(['middleware' => 'auth:api'], function () {
    Route::get('almacen','Api\ApiController@almacen')->name('almacen');
    Route::get('pedidos','Api\ApiController@pedidos')->name('pedidos');
    Route::get('det_pedido','Api\ApiController@det_pedido')->name('det_pedido');

    //**
    Route::get('obras','Api\ApiController@obras')->name('obras');
    Route::get('materiales','Api\ApiController@materiales')->name('materiales');
    Route::get('tipos_obra','Api\ApiController@tiposObra')->name('tipos_obra');
    Route::get('almacen_obras','Api\ApiController@obrasAlmacen')->name('almacen_obras');
    Route::get('pedidos_obras','Api\ApiController@obrasPedidos')->name('pedidos_obras');
    Route::get('det_pedidos_obras','Api\ApiController@detallesPedidos')->name('det_pedidos_obras');

    //Route::get('det_pedidos_obras','Api\ApiController@detallesPedidos')->name('det_pedidos_obras');
    Route::post('add_pedido','Api\ApiController@addPedido');
    Route::post('logout', 'Api\ApiController@logout')->name('logout');

    //todas las notificaciones
    Route::get('notificaciones','Api\ApiController@notifications');
    Route::get('count_notificaciones','Api\ApiController@countNotificationsUnread');
    Route::post('notif_mark_as_read','Api\ApiController@markAsReadNotifications');


    Route::post('update_fcm_token','Api\ApiController@update_fcm_token')->name('update_fcm_token');
});



Route::post('add_det_pedido','Api\ApiController@addDetallePedido');
Route::post('add_pedido_detalles','Api\ApiController@addPedidoDetails');
Route::get('login', 'Api\ApiController@login');


//Route::get('obras','Api\ApiController@obras')->name('obras');



//Route::post('login', 'Api\ApiController@authenticate')->name('login');
/*

Route::get('login', 'Api\ApiController@login');







Route::group(['middleware' => 'jwt.auth'], function () {
    Route::get('obras','Api\ApiController@obras')->name('obras');
    Route::get('almacen','Api\ApiController@almacen')->name('almacen');
    Route::get('pedidos','Api\ApiController@pedidos')->name('pedidos');
    Route::get('det_pedido','Api\ApiController@det_pedido')->name('det_pedido');
    Route::post('logout', 'Api\ApiController@logout')->name('logout');
});

Route::middleware('jwt.refresh')->get('/token/refresh', 'Api\ApiController@refresh');*/