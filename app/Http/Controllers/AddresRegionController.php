<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ShippingAddress;
use Laravolt\Indonesia\Models\City;
use Illuminate\Support\Facades\Auth;
use App\Services\ShippingSetupService;
use Laravolt\Indonesia\Models\District;
use Laravolt\Indonesia\Models\Province;
use App\Http\Requests\StoreShippingAddressRequest;

class AddresRegionController extends Controller
{

    protected $shippingService;

    public function __construct(ShippingSetupService $shippingService)
    {
        $this->shippingService = $shippingService;
    }

    public function getProvinces()
    {
        return response()->json(
            $this->shippingService->getProvinces()
        );
    }

    public function getCities(Request $request)
    {
        return response()->json(
            $this->shippingService->getCities($request->query('province_id'))
        );
    }


    public function getSubdistricts(Request $request)
    {
        return response()->json(
            $this->shippingService->getSubdistricts($request->query('city_id'))
        );
    }

    public function getVillages(Request $request)
    {
        $subdistrict = $request->get('subdistrict');
        $result = $this->shippingService->getDesa($subdistrict);
        return response()->json(
            $result['data']
        );
    }

    public function store(StoreShippingAddressRequest $request, $role)
    {
        $this->shippingService->storeAddress($request, Auth::id());

        return redirect()->back()
            ->with('success', 'Alamat baru berhasil ditambahkan.');
    }
}
