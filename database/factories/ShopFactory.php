<?php

namespace Database\Factories;

use App\Models\Shop;
use Illuminate\Database\Eloquent\Factories\Factory;

class ShopFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Shop::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'company_id'=> $this->faker->numberBetween($min = 2, $max = 4),
            'name' => $this->faker->city,
            'email' => $this->faker->email,
            'slug' => $this->faker->unique()->slug,
            'uuid' => $this->faker->uuid,
            'description' => $this->faker->paragraph($nb =2),
//            'logo' => 'shops/'. $this->faker->image('public/storage/shops',640,480, null, false),
            'type' => $this->faker->randomElement(['fashion','toys','technology','others'])
        ];
    }
}
