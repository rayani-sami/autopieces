<?php
namespace Database\Factories;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
class ProductFactory extends Factory {
    public function definition(): array {
        $name = fake()->words(3, true);
        return [
            'name'        => ucfirst($name),
            'slug'        => Str::slug($name).'-'.fake()->unique()->numberBetween(1000,9999),
            'category_id' => 1,
            'price'       => fake()->randomFloat(3, 5, 500),
            'stock'       => fake()->numberBetween(0, 100),
            'brand'       => fake()->randomElement(['Bosch','NGK','TRW','KYB','LUK','Mann']),
            'is_active'   => true,
            'description' => fake()->paragraph(),
        ];
    }
}
