<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Product>
 */
class ProductFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => $this->faker->word(),
            'aroma' => $this->faker->randomElement(['Lavanda', 'Vainilla', 'Canela', 'Eucalipto']),
            'colour' => $this->faker->safeColorName(),
            'size' => $this->faker->randomElement(['Pequeña', 'Mediana', 'Grande']),
            'material' => $this->faker->randomElement(['Cera de soja', 'Cera de abeja', 'Parafina']),
            'description' => $this->faker->sentence(),
            'price' => $this->faker->randomFloat(2, 1, 100),
            'image' => null,
        ];
        
    }
}
