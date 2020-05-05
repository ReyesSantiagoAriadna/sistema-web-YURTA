<?php

use Illuminate\Http\Request;

//create personal acces client php artisan passport:install

Route::group(['prefix' => 'auth'], function () {


    Route::post('login', 'AuthController@login');
    Route::post('buscar_usuario','AuthController@buscar_usuario');


    Route::post('sendCode','AuthController@sendCode');
    Route::post('verifyCode','AuthController@verifyCode');

    //Route::post('signup', 'AuthController@signup'); // X



    Route::group(['middleware' => 'auth:api'], function() {

        Route::get('logout', 'AuthController@logout');
        Route::get('user', 'AuthController@user');

        //actualizar contraseña
        Route::post('change_password','AuthController@changePassword');
        //actualizar información de usuario
        Route::post('change_inf','AuthController@addInf');

        Route::get('file/avatar','AuthController@avatar');
        Route::post('file/avatar','AuthController@saveAvatar');

        Route::get('productos','Api\ApiController@mostrar_productos');
        Route::get('promociones','Api\ApiController@mostrar_promociones');
        
 
        
    });
    
});


























/*
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
    Route::post('enviar_reporte','Api\ApiController@sendReporte');

    Route::post('update_fcm_token','Api\ApiController@update_fcm_token')->name('update_fcm_token');

    Route::post('qr_entrega','Api\ApiController@qrscan');
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