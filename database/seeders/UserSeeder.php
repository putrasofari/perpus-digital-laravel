<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::create([
            'kelas_id' => 2,
            'name' => 'siswa test',
            'email' => 'siswa@perpus.sch.id',
            'nis_nip' => '12345',
            'role' => 'user',
            'is_active' => true,
            'password' => Hash::make('password'),
        ]);
        User::create([
            'kelas_id' => 2,
            'name' => 'admin test',
            'email' => 'admin@perpus.sch.id',
            'nis_nip' => '678910',
            'role' => 'admin',
            'is_active' => true,
            'password' => Hash::make('password'),
        ]);
    }
}
