<?php

namespace Database\Factories;

use App\Models\Post;
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
    public function definition()
    {
        return [
            'name'         => $this->faker->name,
            'post_id'      => Post::factory()->create(),
            'sale_price'   => $this->faker->randomDigit(),
            'cost_price'   => $this->faker->randomDigit(),
        ];
    }
}
