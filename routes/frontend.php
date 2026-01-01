<?php

Route::group(['as' => 'frontend.', 'namespace' => 'Frontend', 'middleware' => ['web', 'auth', '2fa']], function () {
    Route::get('/home', 'HomeController@index')->name('home');

    // Products - customer can view products with their pricing
    Route::resource('products', 'ProductController', ['only' => ['index', 'show']]);

    // Profile
    Route::get('frontend/profile', 'ProfileController@index')->name('profile.index');
    Route::post('frontend/profile', 'ProfileController@update')->name('profile.update');
    Route::post('frontend/profile/destroy', 'ProfileController@destroy')->name('profile.destroy');
    Route::post('frontend/profile/password', 'ProfileController@password')->name('profile.password');
    Route::post('profile/toggle-two-factor', 'ProfileController@toggleTwoFactor')->name('profile.toggle-two-factor');
});

// Site routes (client-facing frontend)
Route::group(['as' => 'site.', 'namespace' => 'Site', 'middleware' => ['web', 'auth']], function () {
    // Account
    Route::get('/account', 'AccountController@dashboard')->name('account.dashboard');
    Route::get('/account/profile', 'AccountController@profile')->name('account.profile');
    Route::put('/account/profile', 'AccountController@updateProfile')->name('account.profile.update');
    Route::put('/account/password', 'AccountController@updatePassword')->name('account.password.update');
    Route::get('/account/orders', 'AccountController@orders')->name('account.orders');
    Route::get('/account/orders/{id}', 'AccountController@orderShow')->name('account.orders.show');
    
    // Messages
    Route::get('/account/messages', 'MessageController@index')->name('account.messages.index');
    Route::get('/account/messages/create', 'MessageController@create')->name('account.messages.create');
    Route::post('/account/messages', 'MessageController@store')->name('account.messages.store');
    Route::get('/account/messages/{topic}', 'MessageController@show')->name('account.messages.show');
    Route::post('/account/messages/{topic}/reply', 'MessageController@reply')->name('account.messages.reply');
    
    // Shop
    Route::get('/shop', 'ShopController@index')->name('shop.index');
    Route::get('/shop/product/{product}', 'ShopController@show')->name('shop.product');
    
    // Pages
    Route::get('/how-to-order', 'AccountController@howToOrder')->name('how-to-order');
    
    // Cart (placeholder)
    Route::get('/cart', function() { return view('site.cart.index'); })->name('cart');
});
