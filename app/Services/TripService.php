<?php

namespace App\Services;

use App\Models\Trip;

class TripService
{
    /**
     * Ambil semua data trip beserta relasi-relasinya
     *
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function getAllTrips()
    {
        return Trip::with([
            'detail',
            'activities',
            'biayaTrips',
            'destination'
        ])->get();
    }

    /**
     * Ambil detail trip berdasarkan ID beserta relasi-relasinya
     *
     * @param int $id
     * @return \App\Models\Trip|null
     */
    public function getTripById($id)
    {
        return Trip::with([
            'detail',
            'activities',
            'biayaTrips',
            'destination'
        ])->find($id);
    }
}
