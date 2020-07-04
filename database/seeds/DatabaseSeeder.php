<?php

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
        $this->call(RestaurantsSeeder::class);
        $this->call(MealsSeeder::class);
        $this->call(RestaurantsMealsSeeder::class);
    }
}
