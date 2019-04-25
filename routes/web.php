<?php



Route::get('/', [
    'uses'  =>  'NewController@index',
    'as'    =>  '/'
]);


Route::get('/category-product', [
    'uses'  =>  'NewController@categoryproduct',
    'as'    =>  'category-product'
]);

Route::get('/category/add', [
	'uses' =>'CategoryController@index',
	'as'   => 'add-category'
]);

Route::get('/category/manage', [
	'uses' =>'CategoryController@manageCategory',
	'as'   => 'manage-category'
]);

Route::post('/category/save', [
	'uses' =>'CategoryController@saveCategory',
	'as'   => 'new-category'
]);

Route::post('/category/update', [
	'uses' =>'CategoryController@updateCategory',
	'as'   => 'update-category'
]);

Route::get('/category/delete/{id}', [
	'uses' =>'CategoryController@deleteCategory',
	'as'   => 'delete-category'
]);

Route::get('/category/unpublished/{id}', [
	'uses' =>'CategoryController@unpublishedCategory',
	'as'   => 'unpublished-category'
]);

Route::get('/category/published/{id}', [
	'uses' =>'CategoryController@publishedCategory',
	'as'   => 'published-category'
]);
Route::get('/category/edit/{id}', [
	'uses' =>'CategoryController@editCategory',
	'as'   => 'edit-category'
]);

Route::get('/category/deleteCategory/{id}', [
	'uses' =>'CategoryController@deleteCategory',
	'as'   => 'delete-category'
]);




Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
