<?php

namespace Database\Factories;

use App\Models\Product;
use Illuminate\Database\Eloquent\Factories\Factory;

class ProductFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Product::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'name' => $this->faker->city,
            'slug' => $this->faker->unique()->slug,
            'uuid' => $this->faker->uuid,
            'end_date' => $this->faker->dateTimeBetween($startDate = 'now', $endDate = '+30 days', $timezone = null),
            'cost' => $this->faker->numberBetween($min = 100, $max = 500),
            'price' => $this->faker->numberBetween($min = 500, $max = 1000),
            'description'=> $this->faker->paragraph($nb =8),
            'shop_id'=> $this->faker->numberBetween($min = 1, $max = 10),
            'quantity'=> $this->faker->numberBetween($min = 1, $max = 100),
            'product_category_id'=> $this->faker->numberBetween($min = 1, $max = 10)
        ];
    }
}
