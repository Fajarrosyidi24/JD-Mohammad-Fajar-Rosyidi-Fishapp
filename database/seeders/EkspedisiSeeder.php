<?php

namespace Database\Seeders;

use App\Models\CourierService;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class EkspedisiSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = [
            [
                'courier_id' => 1,
                'code' => 'Pos Reguler',
                'name' => 'Reguler',
                'active' => 1,
            ],
            [
                'courier_id' => 1,
                'code' => 'Pos Nextday',
                'name' => 'Nextday',
                'active' => 1,
            ],
            [
                'courier_id' => 1,
                'code' => 'PAKETPOS DANGEROUS GOODS',
                'name' => 'PAKETPOS DANGEROUS GOODS',
                'active' => 1,
            ],
            [
                'courier_id' => 1,
                'code' => 'PAKETPOS VALUABLE GOODS',
                'name' => 'PAKETPOS VALUABLE GOODS',
                'active' => 1,
            ],
            [
                'courier_id' => 1,
                'code' => 'Pos Sameday',
                'name' => 'Sameday',
                'active' => 1,
            ],
            [
                'courier_id' => 1,
                'code' => 'POS KARGO',
                'name' => 'POS KARGO',
                'active' => 1,
            ],


            [
                'courier_id' => 2,
                'code' => 'JAGOPACK',
                'name' => 'Economy Service',
                'active' => 1,
            ],
            [
                'courier_id' => 2,
                'code' => 'REGPACK',
                'name' => 'Regular Service',
                'active' => 1,
            ],
            [
                'courier_id' => 2,
                'code' => 'BOSSPACK',
                'name' => 'Boss Service',
                'active' => 1,
            ],
            [
                'courier_id' => 2,
                'code' => 'BIGPACK',
                'name' => 'Big Package Service',
                'active' => 1,
            ],
            [
                'courier_id' => 2,
                'code' => 'LANDPACK',
                'name' => 'Logistic Service',
                'active' => 1,
            ],
            [
                'courier_id' => 2,
                'code' => 'ONEPACK',
                'name' => 'One Day Service',
                'active' => 1,
            ],
            [
                'courier_id' => 2,
                'code' => 'OTOPACK150',
                'name' => 'Oto Service',
                'active' => 1,
            ],
            [
                'courier_id' => 2,
                'code' => 'OTOPACK250',
                'name' => 'Oto Service',
                'active' => 1,
            ],



            [
                'courier_id' => 3,
                'code' => 'STANDARD',
                'name' => 'Standard Service',
                'active' => 1,
            ],


            [
                'courier_id' => 4,
                'code' => 'STD',
                'name' => 'Reguler',
                'active' => 1,
            ],
            [
                'courier_id' => 4,
                'code' => 'Idtruck',
                'name' => 'Cargo',
                'active' => 1,
            ],
            [
                'courier_id' => 4,
                'code' => 'IDlite',
                'name' => 'Lite',
                'active' => 1,
            ],



            [
                'courier_id' => 5,
                'code' => 'REG',
                'name' => 'Layanan Reguler',
                'active' => 1,
            ],
            [
                'courier_id' => 5,
                'code' => 'BEST',
                'name' => 'Besok Sampai Tujuan',
                'active' => 1,
            ],
            [
                'courier_id' => 5,
                'code' => 'GOKIL',
                'name' => 'Cargo',
                'active' => 1,
            ],
            [
                'courier_id' => 5,
                'code' => 'SIUNT',
                'name' => 'SiUntung',
                'active' => 1,
            ],



            [
                'courier_id' => 6,
                'code' => 'UDRREG',
                'name' => 'Reguler',
                'active' => 1,
            ],
            [
                'courier_id' => 6,
                'code' => 'UDRONS',
                'name' => 'Ons',
                'active' => 1,
            ],
            [
                'courier_id' => 6,
                'code' => 'DRGREG',
                'name' => 'Cargo',
                'active' => 1,
            ],


            [
                'courier_id' => 7,
                'code' => 'DARAT',
                'name' => 'Regular Darat',
                'active' => 1,
            ],
            [
                'courier_id' => 7,
                'code' => 'NRS',
                'name' => 'REGULAR SERVICE',
                'active' => 1,
            ],
            [
                'courier_id' => 7,
                'code' => 'ONS',
                'name' => 'One Night Service',
                'active' => 1,
            ],
            [
                'courier_id' => 7,
                'code' => 'JMR',
                'name' => 'Jawa Murah',
                'active' => 1,
            ],
            [
                'courier_id' => 7,
                'code' => 'NFR',
                'name' => 'Food-Regular Service',
                'active' => 1,
            ],
            [
                'courier_id' => 7,
                'code' => 'NFO',
                'name' => 'Food-One Night Service',
                'active' => 1,
            ],


            [
                'courier_id' => 8,
                'code' => 'ND',
                'name' => 'Next Day',
                'active' => 1,
            ],
            [
                'courier_id' => 8,
                'code' => 'REG',
                'name' => 'Regular',
                'active' => 1,
            ],
            [
                'courier_id' => 8,
                'code' => 'SD',
                'name' => 'Same Day',
                'active' => 1,
            ],


            [
                'courier_id' => 9,
                'code' => 'EXP',
                'name' => 'EXPRESS',
                'active' => 1,
            ],
            [
                'courier_id' => 9,
                'code' => 'REG',
                'name' => 'REGULAR',
                'active' => 1,
            ],
            [
                'courier_id' => 9,
                'code' => 'REX-1',
                'name' => 'REX-1',
                'active' => 1,
            ],
            [
                'courier_id' => 9,
                'code' => 'REX-10',
                'name' => 'REX-0',
                'active' => 1,
            ],
            [
                'courier_id' => 9,
                'code' => 'REX-5',
                'name' => 'REX-5',
                'active' => 1,
            ],



            [
                'courier_id' => 10,
                'code' => 'DARAT ELEKTRONIK',
                'name' => 'DARAT ELEKTRONIK',
                'active' => 1,
            ],
            [
                'courier_id' => 10,
                'code' => 'DARAT NON ELEKTRONIK',
                'name' => 'DARAT NON ELEKTRONIK',
                'active' => 1,
            ],
            [
                'courier_id' => 10,
                'code' => 'UDARA ELEKTRONIK',
                'name' => 'UDARA ELEKTRONIK',
                'active' => 1,
            ],
            [
                'courier_id' => 10,
                'code' => 'UDARA NON ELEKTRONIK',
                'name' => 'UDARA NON ELEKTRONIK',
                'active' => 1,
            ],



            [
                'courier_id' => 11,
                'code' => 'CTC',
                'name' => 'City Courier',
                'active' => 1,
            ],
            [
                'courier_id' => 11,
                'code' => 'CTCYES',
                'name' => 'City Courier YES',
                'active' => 1,
            ],
            [
                'courier_id' => 11,
                'code' => 'CTCSPS',
                'name' => 'City Courier SPS',
                'active' => 1,
            ],
            [
                'courier_id' => 11,
                'code' => 'OKE',
                'name' => 'Ongkos Kirim Ekonomis',
                'active' => 1,
            ],
            [
                'courier_id' => 11,
                'code' => 'REG',
                'name' => 'Layanan Reguler',
                'active' => 1,
            ],
            [
                'courier_id' => 11,
                'code' => 'YES',
                'name' => 'Yakin Esok Sampai',
                'active' => 1,
            ],
            [
                'courier_id' => 11,
                'code' => 'JTR<130',
                'name' => 'Cargo',
                'active' => 1,
            ],
            [
                'courier_id' => 11,
                'code' => 'JTR>130',
                'name' => 'Cargo',
                'active' => 1,
            ],
            [
                'courier_id' => 11,
                'code' => 'JTR<200',
                'name' => 'Cargo',
                'active' => 1,
            ],
            [
                'courier_id' => 11,
                'code' => 'JTR>200',
                'name' => 'Cargo',
                'active' => 1,
            ],


            [
                'courier_id' => 12,
                'code' => 'ECO',
                'name' => 'Economy Service',
                'active' => 1,
            ],
            [
                'courier_id' => 12,
                'code' => 'HDS',
                'name' => 'Holiday Services',
                'active' => 1,
            ],
            [
                'courier_id' => 12,
                'code' => 'ONS',
                'name' => 'Over Night Service',
                'active' => 1,
            ],
            [
                'courier_id' => 12,
                'code' => 'REG',
                'name' => 'Regular Service',
                'active' => 1,
            ],
            [
                'courier_id' => 12,
                'code' => 'SDS',
                'name' => 'Same Day Service',
                'active' => 1,
            ],
            [
                'courier_id' => 12,
                'code' => 'TRC',
                'name' => 'Trucking Service',
                'active' => 1,
            ],



            [
                'courier_id' => 13,
                'code' => 'ECO',
                'name' => 'Regular Service',
                'active' => 1,
            ],
            [
                'courier_id' => 13,
                'code' => 'ONS',
                'name' => 'Over Night Service',
                'active' => 1,
            ],
            [
                'courier_id' => 13,
                'code' => 'SDS',
                'name' => 'Same Day Service',
                'active' => 1,
            ],



            [
                'courier_id' => 14,
                'code' => 'Dokumen',
                'name' => 'Dokumen',
                'active' => 1,
            ],
            [
                'courier_id' => 14,
                'code' => 'Express',
                'name' => 'Express',
                'active' => 1,
            ],
            [
                'courier_id' => 14,
                'code' => 'MOTOR 150 - 250 CC',
                'name' => 'MOTOR 150 - 250 CC',
                'active' => 1,
            ],
            [
                'courier_id' => 14,
                'code' => 'MOTOR',
                'name' => 'MOTOR',
                'active' => 1,
            ],
            [
                'courier_id' => 14,
                'code' => 'Parcel',
                'name' => 'Parcel',
                'active' => 1,
            ],
            [
                'courier_id' => 14,
                'code' => 'Reguler',
                'name' => 'Reguler',
                'active' => 1,
            ],


            [
                'courier_id' => 15,
                'code' => 'EZ',
                'name' => 'Regular Service',
                'active' => 1,
            ],



            [
                'courier_id' => 16,
                'code' => 'Regular Package (RGP)',
                'name' => 'Regular Package',
                'active' => 1,
            ],
            [
                'courier_id' => 16,
                'code' => 'Next Day Package (NDP)',
                'name' => 'Next Day Package',
                'active' => 1,
            ],
            [
                'courier_id' => 16,
                'code' => 'SameDay Package (SDP)',
                'name' => 'SameDay Package',
                'active' => 1,
            ],
            [
                'courier_id' => 16,
                'code' => 'MidDay Package (MDP)',
                'name' => 'MidDay Package',
                'active' => 1,
            ],
            [
                'courier_id' => 16,
                'code' => 'Economy Delivery (ECP)',
                'name' => 'Economy Delivery',
                'active' => 1,
            ],
            [
                'courier_id' => 16,
                'code' => 'Heavy Weight Delivery (HWP)',
                'name' => 'Heavy Weight Delivery',
                'active' => 1,
            ],

            [
                'courier_id' => 17,
                'code' => 'Normal',
                'name' => 'Normal Service',
                'active' => 1,
            ],
        ];

        foreach ($data as $item) {
            CourierService::create($item);
        }
    }
}
