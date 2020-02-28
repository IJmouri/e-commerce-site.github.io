<?php



Route::get('/', [
    'uses'  =>  'NewController@index',
    'as'    =>  '/'
]);


Route::get('/category-product/{id}', [
    'uses'  =>  'NewController@categoryproduct',
    'as'    =>  'category-product'
]);

Route::get('/category/add', [
	'uses' =>'CategoryController@index',
	'as'   => 'add-category'
]);
Route::get('/product/add', [
	'uses' =>'ProductController@index',
	'as'   => 'add-product'
]);
Route::get('/brand/add', [
	'uses' =>'BrandController@index',
	'as'   => 'add-brand'
]);


Route::post('/category/save', [
	'uses' =>'CategoryController@saveCategory',
	'as'   => 'new-category'
]);
Route::post('/brand/save', [
	'uses' =>'BrandController@saveBrand',
	'as'   => 'new-brand'
]);
Route::post('/product/save', [
	'uses' =>'ProductController@saveProduct',
	'as'   => 'new-product'
]);
Route::get('/category/manage', [
	'uses' =>'CategoryController@manageCategory',
	'as'   => 'manage-category'
]);
Route::get('/product/manage',[
	'uses' => 'ProductController@manageProduct',
	'as' => 'manage-product'
]);
Route::get('/brand/manage',[
	'uses' => 'BrandController@manageBrand',
	'as' => 'manage-brand'
]);
Route::post('/category/update', [
	'uses' =>'CategoryController@updateCategory',
	'as'   => 'update-category'
]);
Route::post('/brand/update', [
	'uses' =>'BrandController@updateBrand',
	'as'   => 'update-brand'
]);
Route::post('/product/update', [
	'uses' =>'ProductController@updateProduct',
	'as'   => 'update-product'
]);

Route::get('/category/delete/{id}', [
	'uses' =>'CategoryController@deleteCategory',
	'as'   => 'delete-category'
]);
Route::get('/brand/delete/{id}', [
	'uses' =>'BrandController@deleteBrand',
	'as'   => 'delete-brand'
]);
Route::get('/product/delete/{id}', [
	'uses' =>'ProductController@deleteProduct',
	'as'   => 'delete-product'
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

Route::get('/brand/unpublished/{id}', [
	'uses' =>'BrandController@unpublishedBrand',
	'as'   => 'unpublished-brand'
]);

Route::get('/brand/published/{id}', [
	'uses' =>'BrandController@publishedBrand',
	'as'   => 'published-brand'
]);
Route::get('/brand/edit/{id}', [
	'uses' =>'BrandController@editbrand',
	'as'   => 'edit-brand'
]);


Route::get('/product/unpublished/{id}', [
	'uses' =>'ProductController@unpublishedProduct',
	'as'   => 'unpublished-product'
]);

Route::get('/product/published/{id}', [
	'uses' =>'ProductController@publishedProduct',
	'as'   => 'published-product'
]);
Route::get('/product/edit/{id}', [
	'uses' =>'ProductController@editProduct',
	'as'   => 'edit-product'
]);

Route::get('/product-details/{id}/{name}',[
	'uses' => 'NewController@productDetails',
	'as'   => 'product-details'
]);

Route::post('/cart/add',[
	'uses' => 'CartController@AddToCart',
	'as'   => 'add-to-cart'
]);
Route::get('/cart/show',[
	'uses' => 'CartController@showcart',
	'as'   => 'show-cart'
]);

Route::get('/cart/delete/{id}',[
	'uses' =>'CartController@deleteCart',
	'as'   => 'delete-cart-item'
]);

Route::get('/checkout',[
	'uses' => 'CheckoutController@index',
	'as' => 'checkout'
]);

Route::post('/customer/registration', [
    'uses'  =>  'CheckoutController@customerSignUp',
    'as'    =>  'customer-sign-up'
]);

Route::get('/checkout/shipping', [
    'uses'  =>  'CheckoutController@ShippingForm',
    'as'    =>  'checkout-shipping'
]);
Route::post('/shipping/save', [
    'uses'  =>  'CheckoutController@SaveShippingInfo',
    'as'    =>  'new-shipping'
]);

Route::get('/checkout/payment', [
    'uses'  =>  'CheckoutController@PaymentForm',
    'as'    =>  'checkout-payment'
]);
Route::post('/order/save', [
    'uses'  =>  'CheckoutController@OrderSave',
    'as'    =>  'new-order'
]);

Route::post('/checkout/login', [
    'uses'  =>  'CheckoutController@CustomerLogin',
    'as'    =>  'customer-login'
]);
Route::get('/customer/login/', [
    'uses'  =>  'CheckoutController@DirectCustomerLogin',
    'as'    =>  'direct-customer-login'
]);
Route::post('/customer/logout', [
    'uses'  =>  'CheckoutController@CustomerLogout',
    'as'    =>  'customer-logout'
]);

Route::get('/manage/order', [
    'uses'  =>  'OrderController@ManageOrder',
    'as'    =>  'manage-order'
]);

Route::get('/manage/view-order-detail/{id}', [
    'uses'  =>  'OrderController@ViewOrderDetail',
    'as'    =>  'view-order-detail'
]);
Route::get('/manage/view-order-invoice/{id}', [
    'uses'  =>  'OrderController@ViewOrderInvoice',
    'as'    =>  'view-order-invoice'
]);

Route::get('/manage/download-order-invoice/{id}', [
    'uses'  =>  'OrderController@DownloadOrderInvoice',
    'as'    =>  'download-order-invoice'
]);

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
