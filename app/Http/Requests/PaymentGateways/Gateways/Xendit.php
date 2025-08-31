<?php

namespace App\Http\Requests\PaymentGateways\Gateways;

use Xendit\Configuration;
use Xendit\Invoice\InvoiceApi;

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

        $params = [
            'external_id' => $externalId,
            'payer_email' => 'fajarrosyidi80@gmail.com',
            'description' => 'Pembayaran Pesanan #' . $externalId,
            'amount' => (int) $data['total_price'],
            'success_redirect_url' => route('order.success'),
            'failure_redirect_url' => route('order.failed'),
        ];

        $result = $this->apiInstance->createInvoice($params);
        return $result['invoice_url'];
    }
}
