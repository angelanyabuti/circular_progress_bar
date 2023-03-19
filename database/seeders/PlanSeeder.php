<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PlanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        app('rinvex.subscriptions.plan')->create([
            'name' => 'Basic',
            'description' => 'basic Plan',
            'price' => 100,
            'signup_fee' => 0,
            'invoice_period' => (string) 12,
            'invoice_interval' => 'month',
            'trial_period' => (int) 7,
            'trial_interval' =>  (string)'day',
            'currency' => 'KES',
        ]);
    }
}
