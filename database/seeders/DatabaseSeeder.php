<?php

namespace Database\Seeders;
 use Illuminate\Support\Facades\Hash;
use App\Models\Customer;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // 🔵 Seed products
        $this->call([
            ProductSeeder::class,
        ]);

        // 🟢 Create test customer
       

Customer::create([
    'name' => 'Test User',
    'email' => 'test@example.com',
    'password' => Hash::make('password'),
]);
    }
}