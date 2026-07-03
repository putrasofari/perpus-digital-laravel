<?php

namespace Database\Seeders;

use App\Models\Kelas;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class KelasSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Kelas::create([
            'kelas' => 'X RPL',
            'description' => 'Kelas X RPL',
        ]);
        Kelas::create([
            'kelas' => 'XI RPL 1',
            'description' => 'Kelas XI RPL 1',
        ]);
        Kelas::create([
            'kelas' => 'XI RPL 2',
            'description' => 'Kelas XI RPL 2',
        ]);
    }
}
