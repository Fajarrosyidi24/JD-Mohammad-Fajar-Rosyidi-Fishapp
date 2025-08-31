<?php

namespace App\Http\Controllers;

use Inertia\Inertia;
use Illuminate\Http\Request;

class PaymentController extends Controller
{
    public function invoice(Request $request)
    {
        $invoiceUrl = $request->query('url');
        return Inertia::render('Customer/Payment/index', [
            'invoiceUrl' => $invoiceUrl,
        ]);
    }
}
