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
Route::get('/agregar_usuario','UsuarioController@agregar')->name('usuarios>agregar');
Route::post('/agregar_usuario','UsuarioController@add')->name('usuarios.add');
Route::get('/mostrar_usuarios','UsuarioController@inicio')->name('usuarios');
Route::get('/editar_usuario/{id}','UsuarioController@editar')->name('usuarios>editar');
Route::put('/editar_usuario/{id}','UsuarioController@update')->name('usuarios.update');
Route::delete('/eliminar_usuario/{id}','UsuarioController@eliminar')->name('usuarios.eliminar');
Route::delete('/eliminar_usuario/{id}','UsuarioController@eliminar')->name('usuarios.eliminar'); 

/*PROVEEDORES*/
Route::get('/mostrar_proveedor','ProveedorController@mostrar')->name('proveedores');
Route::get('/agregar_proveedor','ProveedorController@agregar')->name('proveedor>agregar');
Route::post('/agregar_proveedor','ProveedorController@crear_proveedores')->name('crear_proveedor');
Route::get('/editar_proveedor/{id}', 'ProveedorController@editar' )->name('proveedor>editar');
Route::put('/editar_proveedor/{id}','ProveedorController@update')->name('update_proveedor');
Route::delete('/eliminar_proveedor/{id}','ProveedorController@eliminar')->name('eliminar_proveedor');

//TIPOS DE OBRA//
Route::get('/mostrar_tipo_obras','TipoObraController@mostrar')->name('tipo_obras.mostrar');
Route::post('/agregar_tipo_obra','TipoObraController@agregar')->name('tipo_obra.agregar');
Route::get('/editar_tipo_obra{id}', 'TipoObraController@editar' )->name('tipo_obra.editar');
Route::put('/editar_tipo_obra/{id}','TipoObraController@update')->name('tipo_obra.update');
Route::delete('/eliminar_tipo_obra/{id}','TipoObraController@eliminar')->name('tipo_obra.eliminar');


/*MATERIAL*/  
Route::get('/mostrar_material','MaterialController@mostrar')->name('material');  
Route::get('/agregar','MaterialController@agregar')->name('m_agregar');
Route::post('/','MaterialController@crear_material')->name('material_add');
Route::get('/editar/{id}','MaterialController@editar')->name('material>editar');
Route::put('/editar/{id}','MaterialController@update')->name('material_update');
Route::delete('/eliminar/{id}','MaterialController@eliminar')->name('material_eliminar');

/*OBRAS*/
Route::get('/mostrar_obras','ObraController@mostrar')->name('obras');
Route::get('/agregar_obra','ObraController@agregar')->name('obra>agregar');
Route::post('/agregar_obra','ObraController@add')->name('obra>add');
Route::get('/editar_obra/{id}','ObraController@editar')->name('obra>editar');
Route::delete('/elominar/{id}','ObraController@eliminar')->name('obra.eliminar');
//Route::put('/editar_obra/{id}','ObraControlle@update')->name('obra>update');
//Pedidos
Route::get('/mostrar_pedidos','PedidosController@mostrar')->name('pedidos');  
Route::get('/agregar','PedidosController@agregar')->name('agregar_pedido');
Route::post('/','PedidosController@crear_pedido')->name('crear_pedido');
Route::get('/editar/{id}','PedidosController@editar')->name('editar_pedido');
Route::put('/editar/{id}','PedidosController@update')->name('update_pedido');
Route::delete('/editar/{id}','PedidosController@eliminar')->name('eliminar_pedido');
