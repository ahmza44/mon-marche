<?php

namespace Database\Factories;

use App\Models\Product;
use App\Models\Category;
use Illuminate\Database\Eloquent\Factories\Factory;

class ProductFactory extends Factory
{
    protected $model = Product::class;

    public function definition(): array
    {
        return [
            'name' => $this->faker->words(2, true),
            'description' => $this->faker->sentence(),
            'price' => $this->faker->numberBetween(50, 2000),
            'stock' => $this->faker->numberBetween(1, 100),

            // 🔥 dynamic category (random)
            'category_id' => Category::inRandomOrder()->first()->id ?? 1,

            // 🖼️ image fake
            'image' => 'products/' . $this->faker->image(
                storage_path('app/public/products'),
                400,
                400,
                null,
                false
            ),
        ];
    }
}