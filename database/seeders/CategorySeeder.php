<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Support\Facades\DB;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $categories = [
            ['category' => 'food'],
            ['category' => 'drinks'],
            ['category' => 'desserts'],
            // Tambahkan kategori lain sesuai kebutuhan Anda
        ];

        DB::table('category')->insert($categories);
    }
}
