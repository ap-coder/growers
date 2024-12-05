<?php

Route::group(['as' => 'account.', 'namespace' => 'Account', 'middleware' => ['auth', '2fa']], function () {
    Route::get('account/dashboard', 'AccountController@dashboard')->name('account.dashboard');

});

