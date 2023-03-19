<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class CountySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $path = public_path().'/json/counties.json';
        $data = json_decode(file_get_contents($path), true);

        foreach ($data as $datum)
        {
            $county = \App\Models\County::firstOrCreate([
                'name' => $datum['name'],
                'code' => $datum['code']
            ]);
        }
    }
}
