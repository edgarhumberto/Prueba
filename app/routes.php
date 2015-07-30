<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the Closure to execute when that URI is requested.
|
*/
Route::get('/', array('uses' => 'AdminController@showLogin'));
Route::get('login', array('uses' => 'AdminController@showLogin'));
Route::post('login', array('uses' => 'AdminController@doLogin'));
Route::get('logout', array('before'=>'auth', 'uses' => 'AdminController@doLogout'));

Route::get('api/qpones', array('uses' => 'QponesController@json'));

Route::get('qpones', array('before'=>'auth', 'uses' => 'QponesController@mostrarQpones'));
Route::get('qpones/nuevo', array('before'=>'auth', 'uses' => 'QponesController@nuevoQpon'));
Route::post('qpones/crear', array('before'=>'auth', 'uses' => 'QponesController@crearQpon'));
Route::get('qpones/{id}', array('before'=>'auth', 'uses'=>'QponesController@verQpon'));
Route::get('qpones/editar/{id}', array('before'=>'auth', 'uses'=>'QponesController@editarQpon'));
Route::post('qpones/actualizar/{id}', array('before'=>'auth', 'uses'=>'QponesController@actualizarQpon'));
Route::post('qpones/eliminar/{id}', array('before'=>'auth', 'uses'=>'QponesController@eliminarQpon'));

Route::group(array('before'=>'auth'), function(){
	Route::resource('categoriasNegocios', 'CategoriasNegociosController');
});

Route::group(array('before'=>'auth'), function(){
	Route::resource('categoriasQpones', 'CategoriasQponesController');
});

Route::group(array('before'=>'auth'), function(){
	Route::resource('negocios', 'NegociosController');
});

Route::post('negocios/find', array('before'=>'auth', 'uses' => 'NegociosController@find'));
Route::post('negocios/uploadFile', array('before' => 'auth', 'uses' => 'NegociosController@uploadFile'));

Route::any('api/ciudades', array('uses' => 'UbicacionesController@jsonCiudades'));
Route::get('api/paises', array('uses' => 'UbicacionesController@jsonPaises'));
Route::post('api/ubicar', array('uses' => 'UbicacionesController@jsonUbicacion'));
Route::any('api/createUserProfile', array('uses' => 'UsersController@createUserProfile'));
Route::any('api/updateUserProfile', array('uses' => 'UsersController@updateUserProfile'));

Route::any('api/login', array( 'uses' => 'MobileController@login'));
Route::any('api/logout', array( 'uses' => 'MobileController@logout'));

Route::post('api/comments', array('uses' => 'QponesController@jsonComments'));
Route::post('api/saveComment', array('uses' => 'CommentsController@saveComment'));

Route::any('api/search', array('uses' => 'QponesController@jsonSearch'));
Route::any('api/searchVenues', array('uses' => 'NegociosController@jsonSearch'));

Route::any('api/categories', array('uses' => 'CategoriesController@json'));

Route::any('api/types', array('uses' => 'TypesController@json'));

Route::any('api/like', array('uses' => 'QponesController@likeQpon'));
Route::any('api/favorites', array('uses' => 'QponesController@favorites'));

Route::any('api/venue', array('uses' => 'NegociosController@jsonNegocio'));

Route::post('api/useQpon', array('uses' => 'QponesController@consumir'));

Route::any('api/qpons/explore/{page?}', array('uses' => 'QponesController@jsonExplorar'));

Route::any('api/venue/follow', array('uses' => 'NegociosController@followNegocio'));

Route::any('api/historyUser', array('uses' => 'HistoryController@historyUser'));