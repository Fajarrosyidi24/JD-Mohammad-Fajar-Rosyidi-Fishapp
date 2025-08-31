<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use GuzzleHttp\Client;

class OrderController extends Controller
{
    protected string $baseUrl;
    protected array $headers;
    protected Client $client;

    public function __construct()
    {
        $this->baseUrl = "https://api.xendit.co";
        $this->headers = [
            'Content-Type'  => 'application/json',
            'Authorization' => 'Basic ' . base64_encode(config('xendit.secret_key') . ':'), // pastikan ada ":" di belakang
        ];

        $this->client = new Client();
    }

    public function store(Request $request)
    {
        $data = $request->all();

        // mapping cart_items
        $items = collect($data['cart_items'] ?? [])->map(function ($item) {
            return [
                'name'     => $item['name'] ?? 'Unknown Product',
                'quantity' => max(1, (int) ($item['quantity'] ?? 1)),
                'price'    => (int) ($item['price'] ?? 0),
                'category' => 'Seafood',
            ];
        })->toArray();

        // order ID unik
        $orderSerial = 'ORD-' . strtoupper(uniqid());

        $info = [
            'external_id'          => $orderSerial,
            'payer_email'          => $data['email'] ?? 'customer@example.com',
            'description'          => 'Payment for order #' . $orderSerial,
            'amount'               => (int) $data['total_price'],
            'invoice_duration'     => 86400,
            'success_redirect_url' => route('order.success'),
            'failure_redirect_url' => route('order.failed'),
            'currency'             => 'IDR',
            'customer' => [
                'given_names'   => $data['customer_name'] ?? 'Guest',
                'email'         => $data['email'] ?? 'customer@example.com',
                'mobile_number' => $data['phone'] ?? '08123456789',
            ],
            'items' => $items,
        ];

        try {
            $response = $this->client->post($this->baseUrl . "/v2/invoices", [
                'headers' => $this->headers,
                'json'    => $info,
            ]);

            $resBody = json_decode($response->getBody(), true);

            if (isset($resBody['invoice_url'])) {
                return redirect()->route('payment.invoice', [
                    'url' => $resBody['invoice_url']
                ]);
            }

            return response()->json([
                'message' => 'Invoice created but no URL returned',
                'data'    => $resBody,
            ], 200);
        } catch (\Exception $e) {
            // debug error message
            dd($e->getMessage());

            return response()->json([
                'message' => 'Failed to create invoice',
                'error'   => $e->getMessage(),
            ], 500);
        }
    }
}
