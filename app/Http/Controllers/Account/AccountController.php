<?php

namespace App\Http\Controllers\Account;

use App\Http\Controllers\Controller;
use App\Models\Client;
use App\Models\ClientPrice;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class AccountController extends Controller
{
    public function dashboard()
    {
        return view('account.account-dashboard');
    }

    public function address()
    {
        return view('account.account-address');
    }

    public function billingAddress()
    {
        return view('account.account-billing-address');
    }

    public function orderConfirmation()
    {
        return view('account.account-order-confirmation');
    }

    public function orderDetails()
    {
        return view('account.account-order-details');
    }

    public function orders()
    {
        return view('account.account-orders');
    }

    public function profile()
    {
        return view('account.account-profile');
    }

    public function shippingAddress()
    {
        return view('account.account-shipping-address');
    }

    public function shippingMethods()
    {
        return view('account.account-shipping-methods');
    }

    public function returnRequest()
    {
        return view('account.account-return-request');
    }

    public function cancellationRequests()
    {
        return view('account.account-cancellation-requests');
    }

    public function refundRequestsConfirmed()
    {
        return view('account.account-refund-requests-confirmed');
    }

    public function returnRequestDetail()
    {
        return view('account.account-return-request-detail');
    }

    public function downloads()
    {
        return view('account.account-downloads');
    }

    public function paymentMethods()
    {
        return view('account.account-payment-methods');
    }

    public function review()
    {
        return view('account.account-review');
    }
}
