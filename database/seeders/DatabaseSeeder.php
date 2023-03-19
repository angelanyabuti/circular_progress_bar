<?php

namespace Database\Seeders;

use App\Models\Company;
use App\Models\Event;
use App\Models\HomeSlider;
use App\Models\Product;
use App\Models\ProductCategory;
use App\Models\Shop;
use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(CountySeeder::class);
//        // create Companies
//        Company::factory(10)->create();
//
//        // create users
//        User::factory(10)->create();
//
//        // create shops
//        Shop::factory(10)->create();
//
//        //create product categories
//        ProductCategory::factory(20)->create();
//
//        // create products
//        Product::factory(50)->create();
//
//        // Seed Events
//        Event::factory(5)->create();
//
//       //  create home slider items
//        HomeSlider::factory(5)->create();
    }
}
