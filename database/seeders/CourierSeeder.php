<?php

namespace Database\Seeders;

use App\Models\Courier;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class CourierSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $couriers = [
            ['code' => 'POS', 'name' => 'POS Indonesia', 'active' => true],
            ['code' => 'LION', 'name' => 'Lion Parcel', 'active' => true],
            ['code' => 'NINJA', 'name' => 'Ninja Xpress', 'active' => true],
            ['code' => 'IDE', 'name' => 'ID Express', 'active' => true],
            ['code' => 'SICEPAT', 'name' => 'SiCepat Express', 'active' => true],
            ['code' => 'SAP', 'name' => 'SAP Express', 'active' => true],
            ['code' => 'NCS', 'name' => 'Nusantara Card Semesta', 'active' => true],
            ['code' => 'ANTERAJA', 'name' => 'AnterAja', 'active' => true],
            ['code' => 'REX', 'name' => 'Royal Express Indonesia', 'active' => true],
            ['code' => 'SENTRAL', 'name' => 'Sentral Cargo', 'active' => true],
            ['code' => 'JNE', 'name' => 'Jalur Nugraha Ekakurir', 'active' => true],
            ['code' => 'TIKI', 'name' => 'Citra Van Titipan Kilat', 'active' => true],
            ['code' => 'DSE', 'name' => '21 Express', 'active' => true],
            ['code' => 'STAR', 'name' => 'Star Cargo', 'active' => true],
            ['code' => 'JNT', 'name' => 'J&T Express (J&T)', 'active' => true],
            ['code' => 'RPX', 'name' => 'RPX', 'active' => true],
            ['code' => 'WAHANA', 'name' => 'WAHANA EXPRESS', 'active' => true],
        ];

        foreach ($couriers as $courier) {
            Courier::updateOrCreate(
                ['code' => $courier['code']], // Menjaga agar code unik
                ['name' => $courier['name'], 'active' => $courier['active']]
            );
        }
    }
}
