<?php

namespace App\Services;

use Exception;
use App\Models\Courier;
use App\Models\ShippingAddress;
use Laravolt\Indonesia\Models\City;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Config;
use Laravolt\Indonesia\Models\District;
use Laravolt\Indonesia\Models\Province;

class ShippingSetupService
{
    protected $apiKey;
    protected $baseUrl;
    protected $baseUrl2;

    public function __construct()
    {
        $this->apiKey = Config::get('shipping.rajaongkir.api_key');
        $this->baseUrl = "https://pro.rajaongkir.com/api";
        $this->baseUrl2 = "https://rajaongkir.komerce.id/api/v1";
    }

    public function setApiKey($key)
    {
        $this->apiKey = $key;
    }

    public function getApiKey()
    {
        return $this->apiKey;
    }

    public function getProvinces()
    {
        return Province::all()->map(function ($province) {
            return [
                'province_id' => $province->code,
                'province'    => $province->name,
            ];
        });
    }

    public function getCities($provinceId)
    {
        return City::where('province_code', $provinceId)->get()->map(function ($city) {
            return [
                'city_id'     => $city->code,
                'province_id' => $city->province_code,
                'city_name'   => $city->name,
            ];
        });
    }

    public function getSubdistricts($cityId)
    {
        return District::where('city_code', $cityId)->get()->map(function ($district) {
            return [
                'district_id'   => $district->code,
                'city_id'       => $district->city_code,
                'district_name' => $district->name,
            ];
        });
    }

    public function getDesa($kecamatan)
    {
        try {
            if (!$this->apiKey) {
                throw new Exception("API Key tidak ditemukan.");
            }

            $url = $this->baseUrl2 . "/destination/domestic-destination";
            if ($kecamatan) {
                $url .= '?search=' . $kecamatan . '&limit=100&offset=0';
            }

            $response = Http::withHeaders([
                'key' => $this->apiKey,
            ])->get($url);

            if ($response->failed()) {
                throw new Exception("Request gagal: " . $response->body());
            }

            return $response->json();
        } catch (Exception $e) {
            return [
                'error' => true,
                'message' => $e->getMessage(),
            ];
        }
    }

    public function storeAddress($request, $userId)
    {
        $validated = $request->validated();

        $validated['user_id']     = $userId;
        $validated['state']       = $request->state ?? '';
        $validated['city']        = $request->city ?? '';
        $validated['subdistrict'] = $request->subdistrict ?? '';
        $validated['vilage']      = $request->village ?? '';
        $validated['vilage_id']   = $request->village_id;

        return ShippingAddress::create($validated);
    }

     public function rajaOngkirV2($origin, $destination, $weight, $courier)
    {
        $kurir = Courier::where('active', 1)->pluck('code')->toArray();
        $kurirString = implode(':', $kurir);
        try {
            if (!$this->apiKey) {
                throw new Exception("API Key tidak ditemukan. Pastikan sudah dikonfigurasi di config/shipping.php");
            }

            // Kirim request ke API Raja Ongkir
            $response = Http::withHeaders([
                'key' => $this->apiKey,
            ])->asForm()->post("{$this->baseUrl2}/calculate/domestic-cost", [
                'origin'      => (string) $origin,
                'destination' => (string) $destination,
                'weight'      => (int) $weight,
                'courier'     => strtolower($courier),
            ]);

            // Periksa apakah respons berhasil dan key 'rajaongkir' ada
            if ($response->failed()) {
                throw new Exception("Request gagal: " . $response->body());
            }

            // Cek apakah key 'rajaongkir' ada dalam respons
            $responseData = $response->json();
            if (!isset($responseData['meta'])) {
                throw new Exception("Key 'rajaongkir' tidak ditemukan dalam respons.");
            }

            return $responseData['data'];
        } catch (Exception $e) {
            return [
                'error' => true,
                'message' => $e->getMessage(),
            ];
        }
    }
}
