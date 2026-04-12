<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Product;

class ProductSeeder extends Seeder
{
    public function run(): void
    {
       /* Product::create([
            'name' => 'iPhone 15',
            'description' => 'Smartphone Apple',
            'price' => 1200,
            'stock' => 10,
            'category_id' => 1,
        ]);
            
        Product::create([
            'name' => 'Samsung S24',
            'description' => 'Smartphone Samsung',
            'price' => 1100,
            'stock' => 8,
            'category_id' => 1,
        ]);*/
        



        Product::factory()->count(10)->create();
    
    }
}