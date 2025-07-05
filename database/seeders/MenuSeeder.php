<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Menu;

class MenuSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        for($i = 1; $i <= 10; $i++) {
            Menu::create([
                'nama_menu' => 'Menu ' . $i,
                'deskripsi' => 'Deskripsi untuk Menu ' . $i,
                'harga' => rand(10000, 50000),
                'gambar' => 'menu' . $i . '.jpg',
                'kategori' => 'Kategori ' . rand(1, 5),
                'is_active' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}
