<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;

class RestaurantsMealsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $json = File::get(base_path("database/data/restaurants_meals.json"));
        $data = json_decode($json);

        foreach ($data as $row) {
            DB::table("restaurants_meals")->insert((array) $row);
        }
    }
}
