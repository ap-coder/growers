<?php

Route::group(['as' => 'account.', 'namespace' => 'Account', 'middleware' => ['auth', '2fa']], function () {
    Route::get('account/dashboard', 'AccountController@dashboard')->name('account.dashboard');
    Route::get('account/address', 'AccountController@address')->name('account.address');
    Route::get('account/billing-address', 'AccountController@billingAddress')->name('account.billing_address');
    Route::get('account/order-confirmation', 'AccountController@orderConfirmation')->name('account.order_confirmation');
    Route::get('account/order-details', 'AccountController@orderDetails')->name('account.order_details');
    Route::get('account/orders', 'AccountController@orders')->name('account.orders');
    Route::get('account/profile', 'AccountController@profile')->name('account.profile');
    Route::get('account/shipping-address', 'AccountController@shippingAddress')->name('account.shipping_address');
    Route::get('account/shipping-methods', 'AccountController@shippingMethods')->name('account.shipping_methods');
    Route::get('account/return-request', 'AccountController@returnRequest')->name('account.return_request');
    Route::get('account/cancellation-requests', 'AccountController@cancellationRequests')->name('account.cancellation_requests');
    Route::get('account/refund-requests-confirmed', 'AccountController@refundRequestsConfirmed')->name('account.refund_requests_confirmed');
    Route::get('account/return-request-detail', 'AccountController@returnRequestDetail')->name('account.return_request_detail');
    Route::get('account/downloads', 'AccountController@downloads')->name('account.downloads');
    Route::get('account/payment-methods', 'AccountController@paymentMethods')->name('account.payment_methods');
    Route::get('account/review', 'AccountController@review')->name('account.review');
});
