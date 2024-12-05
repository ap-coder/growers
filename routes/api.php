<?php

Route::group(['prefix' => 'v1', 'as' => 'api.', 'namespace' => 'Api\V1\Admin', 'middleware' => ['auth:sanctum']], function () {
    // Faq Category
    Route::apiResource('faq-categories', 'FaqCategoryApiController');

    // Faq Question
    Route::apiResource('faq-questions', 'FaqQuestionApiController');

    // Product Category
    Route::post('product-categories/media', 'ProductCategoryApiController@storeMedia')->name('product-categories.storeMedia');
    Route::apiResource('product-categories', 'ProductCategoryApiController');

    // Product
    Route::post('products/media', 'ProductApiController@storeMedia')->name('products.storeMedia');
    Route::apiResource('products', 'ProductApiController');

    // Order
    Route::apiResource('orders', 'OrderApiController');

    // Client
    Route::apiResource('clients', 'ClientApiController');

    // Client Price
    Route::post('client-prices/media', 'ClientPriceApiController@storeMedia')->name('client-prices.storeMedia');
    Route::apiResource('client-prices', 'ClientPriceApiController');

    // Setting
    Route::apiResource('settings', 'SettingApiController', ['except' => ['show']]);

    // Order Item
    Route::apiResource('order-items', 'OrderItemApiController');
});
