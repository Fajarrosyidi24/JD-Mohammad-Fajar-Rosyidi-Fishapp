<?php

namespace App\Services\PaymentGateways;

use Xendit\Configuration;
use Xendit\Invoice\InvoiceApi;
use Xendit\Invoice\CreateInvoiceRequest;

class Xendit
{
    protected $apiInstance;

    public function __construct()
    {
        $secretKey = config('xendit.secret_key');
        Configuration::setXenditKey($secretKey);
        $this->apiInstance = new InvoiceApi();
    }

    public function createInvoice(array $data)
    {
        $externalId = 'order-' . time();

        $params = new CreateInvoiceRequest([
            'external_id' => $externalId,
            'payer_email' => $data['email'] ?? 'test@example.com',
            'description' => 'Pembayaran Pesanan #' . $externalId,
            'amount' => (int) $data['total_price'],
            'success_redirect_url' => route('order.success'),
            'failure_redirect_url' => route('order.failed'),
        ]);

        $result = $this->apiInstance->createInvoice($params);
        return $result['invoice_url'];
    }
}
