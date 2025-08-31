<?php

namespace App\Http\Controllers\Customer;

use Inertia\Inertia;
use Illuminate\Http\Request;
use App\Models\PaymentGateway;
use App\Models\ShippingAddress;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class CheckoutController extends Controller
{
    public function index(Request $request, $role)
    {
        $gateway = PaymentGateway::with('gatewayOptions')->get();
        $checkoutData = $request->get('checkoutData', []);
        $user = Auth::user();
        $shippingAddresses = ShippingAddress::where('user_id', $user->id)->get();
        return Inertia::render('Customer/Checkout/index', [
            'role' => $role,
            'checkoutData' => $checkoutData,
            'shippingAddresses' => $shippingAddresses,
            'gateway' => $gateway
        ]);
    }
}
