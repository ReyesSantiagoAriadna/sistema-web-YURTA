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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');


Route::get('/agregar_usuario','UsuarioController@agregar')->name('usuarios.agregar');
Route::post('/agregar_usuario','UsuarioController@add')->name('usuarios.add');


Route::get('/mostrar_usuarios','UsuarioController@inicio')->name('usuarios.mostrar');
Route::get('/editar_usuario/{id}','UsuarioController@editar')->name('usuarios.editar');
Route::put('/editar_usuario/{id}','UsuarioController@update')->name('usuarios.update');
Route::delete('/eliminar_usuario/{id}','UsuarioController@eliminar')->name('usuarios.eliminar');