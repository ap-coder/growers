<?php

// Legacy frontend routes - redirect to site routes
Route::group(['as' => 'frontend.', 'middleware' => ['web', 'auth']], function () {
    Route::get('/home', function() { return redirect()->route('site.account.dashboard'); })->name('home');
    Route::get('/products', function() { return redirect()->route('site.shop.index'); })->name('products.index');
    Route::get('/products/{product}', function($product) { return redirect()->route('site.shop.product', $product); })->name('products.show');
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
    
    // Company Info
    Route::get('/account/company', 'AccountController@company')->name('account.company');
    Route::put('/account/company', 'AccountController@updateCompany')->name('account.company.update');
    
    // Locations (Addresses)
    Route::get('/account/locations', 'AccountController@locations')->name('account.locations');
    Route::get('/account/locations/create', 'AccountController@createLocation')->name('account.locations.create');
    Route::post('/account/locations', 'AccountController@storeLocation')->name('account.locations.store');
    Route::get('/account/locations/{address}/edit', 'AccountController@editLocation')->name('account.locations.edit');
    Route::put('/account/locations/{address}', 'AccountController@updateLocation')->name('account.locations.update');
    Route::delete('/account/locations/{address}', 'AccountController@deleteLocation')->name('account.locations.delete');
    Route::post('/account/locations/{address}/set-primary', 'AccountController@setPrimaryLocation')->name('account.locations.setPrimary');
    
    // Messages
    Route::get('/account/messages', 'MessageController@index')->name('account.messages.index');
    Route::get('/account/messages/create', 'MessageController@create')->name('account.messages.create');
    Route::post('/account/messages', 'MessageController@store')->name('account.messages.store');
    Route::get('/account/messages/{topic}', 'MessageController@show')->name('account.messages.show');
    Route::post('/account/messages/{topic}/reply', 'MessageController@reply')->name('account.messages.reply');
    
    // Shop - auth temporarily removed for testing
    Route::get('/shop', 'ShopController@index')->name('shop.index')->withoutMiddleware('auth');
    Route::get('/shop/product/{product}', 'ShopController@show')->name('shop.product')->withoutMiddleware('auth');
    
    // Collections
    Route::get('/collections', 'CollectionController@index')->name('collections.index')->withoutMiddleware('auth');
    Route::get('/collections/{collection}', 'CollectionController@show')->name('collections.show')->withoutMiddleware('auth');
    Route::get('/collections/{collection}/catalog', 'CollectionController@catalog')->name('collections.catalog')->withoutMiddleware('auth');
    
    // FAQs
    Route::get('/faqs', 'FaqController@index')->name('faqs.index')->withoutMiddleware('auth');
    Route::get('/faqs/{id}', 'FaqController@show')->name('faqs.show')->withoutMiddleware('auth');
    
    // Favorites
    Route::post('/favorites/{product}/toggle', 'FavoriteController@toggle')->name('favorites.toggle');
    Route::get('/account/favorites', 'FavoriteController@index')->name('account.favorites');
    
    // Pages
    Route::get('/how-to-order', 'AccountController@howToOrder')->name('how-to-order');
    
    // Cart (placeholder)
    Route::get('/cart', function() { return view('site.cart.index'); })->name('cart');
});
