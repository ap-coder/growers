<?php

// Legacy frontend routes - redirect to site routes
Route::group(['as' => 'frontend.', 'middleware' => ['web', 'auth']], function () {
    Route::get('/account', function() { return redirect()->route('site.account.dashboard'); })->name('home');
    Route::get('/products', function() { return redirect()->route('site.shop.index'); })->name('products.index');
    Route::get('/products/{product}', function($product) { return redirect()->route('site.shop.product', $product); })->name('products.show');
});

// Site routes (client-facing frontend)
Route::group(['as' => 'site.', 'namespace' => 'Site', 'middleware' => ['web', 'auth']], function () {
    // Account
    Route::get('/account/dashboard', 'AccountController@dashboard')->name('account.dashboard');
    Route::get('/account/profile', 'AccountController@profile')->name('account.profile');
    Route::post('/account/profile', 'AccountController@updateProfile')->name('account.profile.update');
    Route::post('/account/password', 'AccountController@updatePassword')->name('account.password.update');
    Route::get('/account/orders', 'AccountController@orders')->name('account.orders');
    Route::get('/account/order-history', 'AccountController@orderHistory')->name('account.order-history');
    Route::get('/account/orders/{id}', 'AccountController@orderShow')->name('account.order-details');
    Route::get('/account/orders/{id}/invoice', 'AccountController@downloadInvoice')->name('order.invoice.download');
    
    // Company Info
    Route::get('/account/company', 'AccountController@company')->name('account.company');
    Route::post('/account/media', 'AccountController@storeMedia')->name('account.storeMedia');
    Route::put('/account/company', 'AccountController@updateCompany')->name('account.company.update');
    
    // Addresses
    Route::get('/account/addresses', 'AccountController@addresses')->name('account.addresses');
    Route::get('/account/addresses/create', 'AccountController@createAddress')->name('account.addresses.create');
    Route::post('/account/addresses', 'AccountController@storeAddress')->name('account.addresses.store');
    Route::get('/account/addresses/{address}/edit', 'AccountController@editAddress')->name('account.addresses.edit');
    Route::put('/account/addresses/{address}', 'AccountController@updateAddress')->name('account.addresses.update');
    Route::delete('/account/addresses/{address}', 'AccountController@deleteAddress')->name('account.addresses.delete');
    Route::post('/account/addresses/{address}/set-primary', 'AccountController@setPrimaryAddress')->name('account.addresses.setPrimary');
    
    // Messages
    Route::get('/account/messages', 'MessageController@index')->name('account.messages.index');
    Route::get('/account/messages/create', 'MessageController@create')->name('account.messages.create');
    Route::post('/account/messages', 'MessageController@store')->name('account.messages.store');
    Route::get('/account/messages/{topic}', 'MessageController@show')->name('account.messages.show');
    Route::post('/account/messages/{topic}/reply', 'MessageController@reply')->name('account.messages.reply');
    
    // Shop - auth temporarily removed for testing (uses slugs)
    Route::get('/shop', 'ShopController@index')->name('shop.index')->withoutMiddleware('auth');
    Route::get('/shop/{product:slug}', 'ShopController@show')->name('shop.product')->withoutMiddleware('auth');
    
    // Collections (uses slugs)
    Route::get('/collections', 'CollectionController@index')->name('collections.index')->withoutMiddleware('auth');
    Route::get('/collections/{collection:slug}', 'CollectionController@show')->name('collections.show')->withoutMiddleware('auth');
    Route::get('/collections/{collection:slug}/catalog', 'CollectionController@catalog')->name('collections.catalog')->withoutMiddleware('auth');
    
    // FAQs
    Route::get('/faqs', 'FaqController@index')->name('faqs.index')->withoutMiddleware('auth');
    Route::get('/faqs/{id}', 'FaqController@show')->name('faqs.show')->withoutMiddleware('auth');
    
    // Favorites/Wishlist
    Route::post('/wishlist/toggle', 'WishlistController@toggle')->name('wishlist.toggle');
    Route::get('/account/wishlist', 'WishlistController@index')->name('account.wishlist');
    
    // Cart
    Route::get('/cart', 'CartController@index')->name('cart.index')->withoutMiddleware('auth');
    Route::post('/cart/add', 'CartController@add')->name('cart.add')->withoutMiddleware('auth');
    Route::post('/cart/update', 'CartController@update')->name('cart.update')->withoutMiddleware('auth');
    Route::get('/cart/remove/{cartId}', 'CartController@remove')->name('cart.remove')->withoutMiddleware('auth');
    Route::get('/cart/remove-product/{productId}', 'CartController@removeProduct')->name('cart.remove.product')->withoutMiddleware('auth');
    Route::get('/cart/clear', 'CartController@clear')->name('cart.clear')->withoutMiddleware('auth');
    Route::get('/checkout', 'CartController@checkout')->name('checkout')->withoutMiddleware('auth');
    
    // Pages
    Route::get('/how-to-order', 'AccountController@howToOrder')->name('how-to-order');
});
