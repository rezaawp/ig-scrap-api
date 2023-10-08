<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\Masyarakat;
use App\Models\Petugas;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);

        Masyarakat::create([
            'nik' => '1234567890123456',
            'nama' => 'Reza Khoirul Wijaya Putra',
            'username' => 'rezawp',
            'password' => bcrypt('password'),
            'telp' => '085714148247'
        ]);

        Petugas::create([
            'nama_petugas' => 'Joko',
            'username' => 'joko',
            'password' => bcrypt('password'),
            'telp' => '1231232132',
            'level' => 'admin'
        ]);
    }
}
