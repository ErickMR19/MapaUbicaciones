<?php

/*
|--------------------------------------------------------------------------
| Routes File
|--------------------------------------------------------------------------
|
| Here is where you will register all of the routes in an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/
/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| This route group applies the "web" middleware group to every route
| it contains. The "web" middleware group is defined in your HTTP
| kernel and includes session state, CSRF protection, and more.
|
*/

Route::group(['middleware' => ['web']], function () {
    //
});

Route::group(['middleware' => 'web'], function () {
    Route::auth();

    Route::get('/', 'HomeController@welcome');
    Route::get('/home','HomeController@index');


	Route::get('provincias',array('as'=>'indexprovincia','uses'=>'ProvinciasController@indexProvincia'));
	Route::get('provincias/json',array('as'=>'alljson','uses'=>'ProvinciasController@allToJson'));
	Route::get('provincias/create',array('as'=>'createprovincia','uses'=>'ProvinciasController@createProvincia'));
	Route::post('provincias/register',array('as'=>'storeprovincia','uses'=>'ProvinciasController@saveProvincia'));
	Route::get('provincias/{provincia}',array('as'=>'showprovincia','uses'=>'ProvinciasController@showProvincia'));
	Route::get('provincias/{provincia}/edit',array('as'=>'editprovincia','uses'=>'ProvinciasController@editProvincia'));
	Route::put('provincias/{provincia}',array('as'=>'updateprovincia','uses'=>'ProvinciasController@updateProvincia'));
	Route::delete('provincias/{provincia}',array('as'=>'deleteprovincia','uses'=>'ProvinciasController@deleteProvincia'));

	Route::get('cantones',array('as'=>'indexcanton','uses'=>'CantonesController@indexCanton'));
	Route::get('cantones/create',array('as'=>'createcanton','uses'=>'CantonesController@createCanton'));
	Route::post('cantones/register',array('as'=>'storecanton','uses'=>'CantonesController@saveCanton'));
	Route::get('cantones/{canton}',array('as'=>'showcanton','uses'=>'CantonesController@showCanton'));
	Route::get('cantones/{canton}/edit',array('as'=>'editcanton','uses'=>'CantonesController@editCanton'));
	Route::put('cantones/{canton}',array('as'=>'updatecanton','uses'=>'CantonesController@updateCanton'));
	Route::delete('cantones/{canton}',array('as'=>'deletecanton','uses'=>'CantonesController@deleteCanton'));

	Route::get('distritos',array('as'=>'indexdistrito','uses'=>'DistritosController@indexDistrito'));
	Route::get('distritos/create',array('as'=>'createdistrito','uses'=>'DistritosController@createDistrito'));
	Route::post('distritos/register',array('as'=>'storedistrito','uses'=>'DistritosController@saveDistrito'));
	Route::get('distritos/{distrito}',array('as'=>'showdistrito','uses'=>'DistritosController@showDistrito'));
	Route::get('distritos/{distrito}/edit',array('as'=>'editdistrito','uses'=>'DistritosController@editDistrito'));
	Route::put('distritos/{distrito}',array('as'=>'updatedistrito','uses'=>'DistritosController@updateDistrito'));
	Route::delete('distritos/{distrito}',array('as'=>'deletedistrito','uses'=>'DistritosController@deleteDistrito'));
	
	Route::get('categorias',array('as'=>'indexcategoria','uses'=>'CategoriasController@indexCategoria'));
	Route::get('categorias/create',array('as'=>'createcategoria','uses'=>'CategoriasController@createCategoria'));
	Route::post('categorias/register',array('as'=>'storecategoria','uses'=>'CategoriasController@saveCategoria'));
	Route::get('categorias/{categoria}',array('as'=>'showcategoria','uses'=>'CategoriasController@showCategoria'));
	Route::get('categorias/{categoria}/edit',array('as'=>'editcategoria','uses'=>'CategoriasController@editCategoria'));
	Route::put('categorias/{categoria}',array('as'=>'updatecategoria','uses'=>'CategoriasController@updateCategoria'));
	Route::delete('categorias/{categoria}',array('as'=>'deletecategoria','uses'=>'CategoriasController@deleteCategoria'));

	Route::get('ubicaciones',array('as'=>'indexubicacion','uses'=>'UbicacionesController@indexUbicacion'));
	Route::get('ubicaciones/json',array('as'=>'ubicacionesjson','uses'=>'UbicacionesController@allToJson'));
	Route::get('ubicaciones/create',array('as'=>'createubicacion','uses'=>'UbicacionesController@createUbicacion'));
	Route::post('ubicaciones/register',array('as'=>'storeubicacion','uses'=>'UbicacionesController@saveUbicacion'));
	Route::get('ubicaciones/{ubicacion}',array('as'=>'showubicacion','uses'=>'UbicacionesController@showUbicacion'));
	Route::get('ubicaciones/{ubicacion}/edit',array('as'=>'editubicacion','uses'=>'UbicacionesController@editUbicacion'));
	Route::put('ubicaciones/{ubicacion}',array('as'=>'updateubicacion','uses'=>'UbicacionesController@updateUbicacion'));
	Route::delete('ubicaciones/{ubicacion}',array('as'=>'deleteubicacion','uses'=>'UbicacionesController@deleteUbicacion'));

});
