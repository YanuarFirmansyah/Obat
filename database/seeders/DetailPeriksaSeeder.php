<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\DetailPeriksa;

class DetailPeriksaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = [
            [
                'id_periksa' => 1,
                'id_obat' => 1
            ],
            [
                'id_periksa' => 1,
                'id_obat' => 2
            ],
            [
                'id_periksa' => 2,
                'id_obat' => 3
            ],
            [
                'id_periksa' => 2,
                'id_obat' => 4
            ],
            [
                'id_periksa' => 3,
                'id_obat' => 5
            ],
            [
                'id_periksa' => 3,
                'id_obat' => 6
            ]
            ];
            foreach($data as $d){
                DetailPeriksa::create([
                    'id_periksa' => $d['id_periksa'],
                    'id_obat' => $d['id_obat']
                ]);
            }
    }
}