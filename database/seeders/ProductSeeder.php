<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Models\Product;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        DB::table('products')->insert([
            [
                'image' => 'Laptop-asus-rog.jpg',
                'name' => 'Laptop ASUS ROG',
                'description' => 'Laptop Gaming performa Tinggi',
                'price' => 15000000,
                'stock' => 10,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'image' => 'mouse-logistech-wireless.jpg',
                'name' => 'Mouse Logistech Wireless',
                'description' => 'Mouse ergonomis tanpa kabel',
                'price' => 350000,
                'stock' => 25,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);

        Product::factory()->count(10)->create();
    }
}
