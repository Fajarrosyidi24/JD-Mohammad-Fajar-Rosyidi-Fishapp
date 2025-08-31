<?php

namespace Database\Seeders;

use App\Enums\Activity;
use App\Enums\InputType;
use App\Enums\GatewayMode;
use App\Models\GatewayOption;
use App\Models\PaymentGateway;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class PaymentGatewaySeeder extends Seeder
{
    public array $gateways = [
        [
            "name"    => "Xendit",
            "slug"    => "xendit",
            "misc"    => null,
            "status"  => Activity::DISABLE,
            "options" => [
                [
                    "option"     => 'xendit_secretKey',
                    "type"       => InputType::TEXT,
                    "activities" => ''
                ],
                [
                    "option"     => 'xendit_mode',
                    "type"       => InputType::SELECT,
                    "activities" => [
                        GatewayMode::SANDBOX => 'test',
                        GatewayMode::LIVE    => 'live'
                    ]
                ],
                [
                    "option"     => 'xendit_status',
                    "value"      => Activity::DISABLE,
                    "type"       => InputType::SELECT,
                    "activities" => [
                        Activity::ENABLE  => "enable",
                        Activity::DISABLE => "disable",
                    ]
                ],
            ]
        ]
    ];
    
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
         foreach ($this->gateways as $gateway) {
            $payment = PaymentGateway::create([
                'name'   => $gateway['name'],
                'slug'   => $gateway['slug'],
                'misc'   => json_encode($gateway['misc']),
                'status' => $gateway['status']
            ]);

            if (file_exists(public_path('/images/seeder/payment-gateway/' . strtolower(str_replace(' ', '_', $gateway['slug'])) . '.png'))) {
                $payment->addMedia(public_path('/images/seeder/payment-gateway/' . strtolower(str_replace(' ', '_', $gateway['slug'])) . '.png'))->preservingOriginal()->toMediaCollection('payment-gateway');
            }
            $this->gatewayOption($payment->id, $gateway['options']);
        }
    }

    public function gatewayOption($id, $options): void
    {
        if (!blank($options)) {
            foreach ($options as $option) {
                GatewayOption::create([
                    'model_id'   => $id,
                    'model_type' => PaymentGateway::class,
                    'option'     => $option['option'],
                    'value'      => $option['value'] ?? "",
                    'type'       => $option['type'],
                    'activities' => json_encode($option['activities']),
                ]);
            }
        }
    }
}
