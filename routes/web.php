<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');


Route::view('/', 'welcome');
/*USUARIOS*/
Route::get('/agregar_usuario','UsuarioController@agregar')->name('usuarios.agregar');
Route::post('/agregar_usuario','UsuarioController@add')->name('usuarios.add');
Route::get('/mostrar_usuarios','UsuarioController@inicio')->name('usuarios.mostrar');
Route::get('/editar_usuario/{id}','UsuarioController@editar')->name('usuarios.editar');
Route::put('/editar_usuario/{id}','UsuarioController@update')->name('usuarios.update');
Route::delete('/eliminar_usuario/{id}','UsuarioController@eliminar')->name('usuarios.eliminar');
Route::delete('/eliminar_usuario/{id}','UsuarioController@eliminar')->name('usuarios.eliminar'); 

/*PROVEEDORES*/
Route::get('/mostrar_proveedor','ProveedorController@mostrar')->name('proveedores.mostrar');
Route::get('/agregar','ProveedorController@agregar')->name('agregar_proveedor');
Route::post('/agregar','ProveedorController@crear_proveedores')->name('crear_proveedor');
Route::get('/editar_proveedor/{id}', 'ProveedorController@editar' )->name('editar');
Route::put('/editar_proveedor/{id}','ProveedorController@update')->name('update_proveedor');
Route::delete('/eliminar/{id}','ProveedorController@eliminar')->name('eliminar_proveedor');

//TIPOS DE OBRA//
Route::get('/mostrar_tipo_obras','TipoObraController@mostrar')->name('tipo_obras.mostrar');
Route::post('/agregar_tipo_obra','TipoObraController@agregar')->name('tipo_obra.agregar');
Route::get('/editar_tipo_obra{id}', 'TipoObraController@editar' )->name('tipo_obra.editar');
Route::put('/editar_tipo_obra/{id}','TipoObraController@update')->name('tipo_obra.update');
Route::delete('/eliminar_tipo_obra/{id}','TipoObraController@eliminar')->name('tipo_obra.eliminar');

/*MATERIAL*/
Route::get('/mostrar_material','MaterialController@mostrar')->name('mostrar_material');  
Route::get('/agregar','MaterialController@agregar')->name('agregar.material');
Route::post('/','MaterialController@crear_material')->name('material_add');
Route::get('/editar/{id}','MaterialController@editar')->name('materiales_editar');
Route::put('/editar/{id}','MaterialController@update')->name('material_update');
Route::delete('/eliminar/{id}','MaterialController@eliminar')->name('material_eliminar');

//Pedidos
Route::get('/mostrar_pedidos','PedidosController@mostrar')->name('mostrar_proveedor');  
Route::get('/agregar','PedidosController@agregar')->name('agregar_pedido');
Route::post('/','PedidosController@crear_pedido')->name('crear_pedido');
Route::get('/editar/{id}','PedidosController@editar')->name('editar_pedido');
Route::put('/editar/{id}','PedidosController@update')->name('update_pedido');
Route::delete('/editar/{id}','PedidosController@eliminar')->name('eliminar_pedido');