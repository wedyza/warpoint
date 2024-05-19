<?php

namespace Database\Factories;

use App\Models\Subcategory;
use Illuminate\Database\Eloquent\Factories\Factory;

class ProductFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'name' => $this->faker->word(),
            'price' => $this->faker->randomFloat(2, 2000, 5000),
            'description' => $this->faker->sentence(),
            'avatar' => 'https://source.unsplash.com/random',
            'subcategory_id' => Subcategory::factory(1)->create()[0]->id
        ];
    }
}
