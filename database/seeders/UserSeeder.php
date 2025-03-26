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
                'nama' => 'iqbal',
                'alamat' => 'Jl kebangsaan',
                'no_hp' => '0822917181',
                'role' => 'pasien',
                'email' => 'iqbal@gmail.com',
                'password' => 'password'
            ],
            [
                'nama' => 'jiah',
                'alamat' => 'Jl kekuasaan',
                'no_hp' => '081313131242',
                'role' => 'dokter',
                'email' => 'jadadhl@gmail.com',
                'password' => 'password'
            ],
        ];

        foreach($data as $d){
            User::create([
                'nama' => $d['nama'],
                'email' => $d['email'],
                'password' => $d['password'],
                'alamat' => $d['alamat'],
                'no_hp' => $d['no_hp'],
                'role' => $d['role'],
            ]);
        }
    }
}
