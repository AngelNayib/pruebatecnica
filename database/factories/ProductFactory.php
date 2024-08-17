<?php

namespace Database\Factories;

use App\Models\Category;
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
        $category = Category::all()->random();
        return [
            'nombre' => $this->faker->sentence(2),
            'descripcion' => $this->faker->text(),
            'precio' => $this->faker->randomElement([9.99, 25.99, 99.99]),
            'cantidad' => $this->faker->numberBetween(1, 10),
            'category_id' => $category->id,
        ];
    }
}
