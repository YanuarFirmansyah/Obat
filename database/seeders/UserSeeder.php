<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = [
            [
                'nama' => 'Iqbal',
                'alamat' => 'Jl Imam Bonjol',
                'no_hp' => '090990909',
                'role' => 'dokter',
                'email' => 'iqbal@gmail.com',
                'password' => 'password',
                'id_poli' => 2
            ],
            [
                'nama' => 'neena',
                'alamat' => 'Jl Imam Bonjol',
                'no_hp' => '09087878',
                'role' => 'dokter',
                'email' => 'neena@gmail.com',
                'password' => 'password',
                'id_poli' => 3
            ],
            [
                'nama' => 'Budi',
                'alamat' => 'Jl Imam Bonjol',
                'no_hp' => '09087822278',
                'role' => 'pasien',
                'email' => 'budi@gmail.com',
                'password' => 'password'
            ],
            [
                'nama' => 'Doremi',
                'alamat' => 'Jl Imam Bonjol10',
                'no_hp' => '090878212278',
                'role' => 'pasien',
                'email' => 'doremi@gmail.com',
                'password' => 'password'
            ],
            [
                'nama' => 'Fasola',
                'alamat' => 'Jl Imam Bonjol10',
                'no_hp' => '033878212278',
                'role' => 'pasien',
                'email' => 'fasola@gmail.com',
                'password' => 'password'

            ],
             [
                'nama' => 'Admin',
                'alamat' => 'Jl Imam Bonjol12',
                'no_hp' => '08725782252',
                'role' => 'admin',
                'email' => 'admin@gmail.com',
                'password' => 'password'
            ]
            ];
        foreach($data as $d){
            User::create([
                'nama' => $d['nama'],
                'email' => $d['email'],
                'password' => $d['password'],
                'alamat' => $d['alamat'],
                'no_hp' => $d['no_hp'],
                'role' => $d['role']
            ]);
        }
    }
}