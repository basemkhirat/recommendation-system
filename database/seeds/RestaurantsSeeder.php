<?php

use Illuminate\Database\Seeder;
use App\Models\Restaurant;
use Illuminate\Support\Facades\File;

class RestaurantsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $json = File::get(base_path("database/data/restaurants.json"));
        $data = json_decode($json);

        foreach($data as $row) {
            Restaurant::create((array)$row);
        }
    }
}
