<?php

Route::group(['prefix' => 'v1', 'as' => 'api.', 'namespace' => 'Api\V1\Admin', 'middleware' => ['auth:sanctum']], function () {
    // Product
    Route::post('products/media', 'ProductApiController@storeMedia')->name('products.storeMedia');
    Route::apiResource('products', 'ProductApiController');

    // Customer
    Route::apiResource('customers', 'CustomerApiController');

    // Order
    Route::apiResource('orders', 'OrderApiController');

    // Client
    Route::apiResource('clients', 'ClientApiController');

    // Client Price
    Route::apiResource('client-prices', 'ClientPriceApiController');

    // Setting
    Route::apiResource('settings', 'SettingApiController', ['except' => ['show']]);

    // Order Item
    Route::apiResource('order-items', 'OrderItemApiController');
});
