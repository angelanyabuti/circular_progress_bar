<?php

namespace Database\Factories;

use App\Models\ProductCategory;
use Illuminate\Database\Eloquent\Factories\Factory;

class ProductCategoryFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = ProductCategory::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'name' => $this->faker->word,
            'uuid' => $this->faker->uuid,
            'slug' => $this->faker->unique()->slug,
//            'image' => 'product/category/'. $this->faker->image('public/storage/product/category',640,480, null, false),
            'description'=> $this->faker->paragraph($nb =8)
        ];
    }
}
