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

Route::get('/home', function () {
    return view('welcome');
});

Auth::routes();
Route::group(['prefix'=>'admin','as'=>'admin.','middleware'=>['auth']],function(){
	Route::get('/home', 'HomeController@index')->name('home');
	// categories 
	Route::get('/category/','categoryController@index')->name('index_category');
	Route::get('/category/create','categoryController@create')->name('create_category');
	Route::post('/category/store','categoryController@store')->name('store_category');
	Route::DELETE('/category/delete/{id}','categoryController@destroy')->name('delete_category');
	Route::get('/category/edit/{id}','categoryController@edit')->name('edite_category');
	Route::post('category/update/','categoryController@update')->name('update_category');
	// products
	Route::get('/product/','productController@index')->name('index_product');
	Route::get('/product/create','productController@create')->name('create_product');
	Route::post('/product/store','productController@store')->name('store_product');
	Route::get('/product/edit/{id}','productController@edit')->name('edit_product');
	Route::post('product/update/','productController@update')->name('update_product');
	Route::DELETE('/product/delete/{id}','productController@destroy')->name('delete_products');
	// users userController
	Route::get('/user/','userController@index')->name('index_user');
	Route::get('/user/create','userController@create')->name('create_user');
	Route::post('/user/store','userController@store')->name('store_user');
	Route::get('/user/edit/{id}','userController@edit')->name('edit_user');
	Route::post('user/update/','userController@update')->name('update_user');
	Route::DELETE('/user/delete/{id}','userController@destroy')->name('delete_user');


});
	//findproduct
	Route::get('/','HomeController@front');
	Route::post('/findproduct','HomeController@search');
