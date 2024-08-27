<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

// use App\Models\Masterpegawai;

use App\Models\Masteranggota;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Auth\Events\Login;
use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // DB::table('masterpegawais')->insert([
        //     'kode' => '1111',
        //     'nama' => 'Hendra',
        //     'no_telp' => '081999234478',
        // ]);

        User::create([
            'name' => 'Riska',
            'email' => 'riska@gmail.com',
            'password' => bcrypt('1'),
            'roles' => 'kepalaperpus'
        ]);
        User::create([
            'name' => 'Rizky',
            'email' => 'rizky@gmail.com',
            'password' => bcrypt('2'),
            'roles' => 'petugas'
        ]);
        User::create([
            'name' => 'Reza',
            'email' => 'reza@gmail.com',
            'password' => bcrypt('3'),
            'roles' => 'siswa'
        ]);
        User::create([
            'name' => 'Rahman',
            'email' => 'rahman@gmail.com',
            'password' => bcrypt('4'),
            'roles' => 'siswa'
        ]);
        

        // MasterData
        // Masterkategori::create([
        //     'nama' => 'Komik',
        // ]);
        // Masterkategori::create([
        //     'nama' => 'Fiksi',
        // ]);
        // Masterkategori::create([
        //     'nama' => 'Novel',
        // ]);


    }
}
