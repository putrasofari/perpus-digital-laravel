<?php

namespace Database\Seeders;

use App\Models\Book;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class BookSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Book::create([
            'category_id' => 1,
            'judul' => 'Matematika Kelas XI',
            'penulis' => 'Penulis 1',
            'penerbit' => 'Penerbit 1',
            'tahun_terbit' => '2026',
            'jmlh_halaman' => '160',
            'stok' => 12,
            'image' => null,
        ]);
    }
}
