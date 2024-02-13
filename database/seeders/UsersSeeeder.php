<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UsersSeeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::Create([
            'name'=> 'Kesiswaan',
            'username'=>'Kesiswaan',
            'email' => 'kesiswaan@gmail.com',
            'password'=>Hash::make('kesiswaan123'),
            'role'=>'Kesiswaan'
        ]);

        User::Create([
            'name'=> 'Siswa',
            'username'=>'Siswa',
            'email' => 'siswa@gmail.com',
            'password'=>Hash::make('siswa123'),
            'role'=>'Siswa'
        ]);

        User::Create([
            'name'=> 'Pelatih',
            'username'=>'Pelatih',
            'email' => 'pelatih@gmail.com',
            'password'=>Hash::make('pelatih123'),
            'role'=>'Pelatih'
        ]);
    }
}
