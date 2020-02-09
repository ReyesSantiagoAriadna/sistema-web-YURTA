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

Route::get('/','PagesController@inicio')->name('inicio');
 
/*PROVEEDORES*/
Route::get('/proveedor','PagesController@ver_proveedor')->name('ver_proveedor'); 
Route::get('/form_agregar','PagesController@agregar_proveedores')->name('agregar_proveedor');
Route::post('/','PagesController@crear_proveedores')->name('crear_proveedor');
Route::get('/editar/{id}', 'PagesController@editarProveedores' )->name('editar');
Route::put('/editar/{id}','PagesController@update_proveedores')->name('update_proveedor');
Route::delete('/eliminar/{id}','PagesController@eliminar_proveedores')->name('eliminar_proveedor');