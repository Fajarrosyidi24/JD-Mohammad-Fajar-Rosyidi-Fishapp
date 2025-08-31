<?php

namespace App\Http\Controllers;

use App\Models\Courier;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class CourierController extends Controller
{
    public function active(Request $request)
    {
        $village_id = $request->query('village_id');
        $weight = (int) $request->query('weight', 100);

        $origin = 31000;
        $destination = $village_id;

        // Ambil kode kurir aktif dari database
        $activeCouriers = Courier::where('active', 1)->pluck('code')->toArray();
        $courierString = implode(':', $activeCouriers);

        // Ambil layanan aktif dari database dan kelompokkan berdasarkan kode kurir
        $allowedServices = [];
        $couriersWithServices = Courier::with(['ekspedisis' => function ($query) {
            $query->where('active', 1);
        }])->where('active', 1)->get();

        foreach ($couriersWithServices as $courier) {
            $courierCode = strtoupper($courier->code);
            foreach ($courier->ekspedisis as $service) {
                $allowedServices[$courierCode][] = $service->code;
            }
        }

        // Inisialisasi service dan hasil akhir
        $shippingService = app(\App\Services\ShippingSetupService::class);
        $couriers = [];

        try {
            // Panggil API RajaOngkir
            $response = $shippingService->rajaOngkirV2($origin, $destination, $weight, $courierString);

            if (!empty($response)) {
                foreach ($response as $cost) {
                    $courierCode = strtoupper($cost['code']);
                    $serviceCode = $cost['service'];
                    if (
                        isset($allowedServices[$courierCode]) &&
                        in_array($serviceCode, $allowedServices[$courierCode])
                    ) {
                        $couriers[] = [
                            'code' => $courierCode,
                            'name' => $cost['name'],
                            'service' => $serviceCode,
                            'description' => $cost['description'],
                            'cost' => $cost['cost'],
                            'etd' => $cost['etd'] ?? '-',
                        ];
                    }
                }
            }
        } catch (\Exception $e) {
            Log::warning("Kurir gagal: " . $e->getMessage());
        }
        return response()->json($couriers);
    }
}
