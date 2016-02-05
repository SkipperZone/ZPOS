<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/Route::group(['middleware' => 'language'], function()
{
	Route::get('/', 'HomeController@index');
	Route::get('/items/search', 'SearchController@items');
	Route::get('/sales/search', 'SearchController@sales');
	Route::get('/api/items/search', 'SearchController@readBarcode');
	Route::get('/api/sales/search', 'SearchController@readSales');
	Route::get('/api/locations/search', 'SearchController@readLocation');
	Route::get('/api/location_moving/search', 'SearchController@readLocationMoving');
	Route::get('/api/group/search', 'SearchController@readGroup');

	Route::get('home', 'HomeController@index');
	Route::get('items/barcode/print/{id}', 'ItemController@barcode');
	
	// Gudang routes
	Route::get('warehouse_move_items', 'LocationController@move');
	Route::get('warehouse_move_items/create', 'LocationController@move_create');
	Route::get('warehouse_move_items/search', 'SearchController@location');
	Route::get('warehouse_move_items/{id}/edit', 'LocationController@move_edit');
	Route::post('warehouse_move_items/create', 'LocationController@move_store');
	Route::post('warehouse_move_items/create/additems', 'LocationController@additems');
	Route::post('warehouse_move_items/removeitem/{key}', 'LocationController@removeitem');
	Route::post('warehouse_move_items/saveall', 'LocationController@saveall');
	
	// Authentication routes...
	Route::get('auth/login', 'Auth\AuthController@getLogin');
	Route::post('auth/login', 'Auth\AuthController@postLogin');
	Route::get('auth/logout', 'Auth\AuthController@getLogout');

	// Registration routes...
	Route::get('auth/register', 'Auth\AuthController@getRegister');
	Route::post('auth/register', 'Auth\AuthController@postRegister');

	// Password reset link request routes...
	Route::get('password/email', 'Auth\PasswordController@getEmail');
	Route::post('password/email', 'Auth\PasswordController@postEmail');

	// Password reset routes...
	Route::get('password/reset/{token}', 'Auth\PasswordController@getReset');
	Route::post('password/reset', 'Auth\PasswordController@postReset');

	Route::resource('customers', 'CustomerController');
	Route::resource('satuan', 'SatuanController');
	Route::resource('warehouse', 'LocationController');
	Route::resource('item_group', 'ItemGroupController');
	Route::resource('items', 'ItemController');
	Route::resource('item-kits', 'ItemKitController');
	Route::resource('inventory', 'InventoryController');
	Route::resource('suppliers', 'SupplierController');
	Route::resource('receivings', 'ReceivingController');
	Route::resource('receiving-item', 'ReceivingItemController');
	Route::resource('sales', 'SaleController');

	Route::resource('reports/receivings', 'ReceivingReportController');
	Route::resource('reports/sales', 'SaleReportController');

	Route::get('reports/stock_items', 'InventoryReportController@stock');
	Route::get('reports/stock_items/print', 'InventoryReportController@cetakPdf');
	Route::get('reports/stock_items/search', 'InventoryReportController@search');
	

	Route::resource('employees', 'EmployeeController');

	Route::get('/items/salesearch', 'ReceivingApiController@scanitem');
	Route::resource('api/item', 'ReceivingApiController');
	Route::resource('api/scan', 'ReceivingApiController@scan');
	// Route::resource('api/scan/{id}', 'ReceivingApiController@scan');
	Route::resource('api/receivingtemp', 'ReceivingTempApiController');

	Route::resource('api/saletemp', 'SaleTempApiController');

	Route::resource('api/itemkittemp', 'ItemKitController');
	Route::get('api/item-kit-temp', 'ItemKitController@itemKitApi');
	Route::get('api/item-kits', 'ItemKitController@itemKits');
	Route::post('store-item-kits', 'ItemKitController@storeItemKits');

	Route::resource('tutapos-settings', 'TutaposSettingController');
});
