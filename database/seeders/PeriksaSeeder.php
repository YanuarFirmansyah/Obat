<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\models\Periksa;

class PeriksaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = [
            [
                'id_pasien' => 25,
                'id_dokter' => 26,
                'catatan' => 'periksa pertama',
                'tgl_periksa' => '2025-03-18 21:00:00',
                'biaya_periksa' => 50000
            ],
            
        ];

        foreach($data as $d){
            Periksa::create([
                'id_pasien' => $d['id_pasien'],
                'id_dokter' => $d['id_dokter'],
                'catatan' => $d['catatan'],
                'tgl_periksa' => $d['tgl_periksa'],
                'biaya_periksa' => $d['biaya_periksa']
            ]);
        }
    }
}
