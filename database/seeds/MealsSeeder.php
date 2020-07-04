<?php

use Illuminate\Database\Seeder;
use App\Models\Meal;
use Illuminate\Support\Facades\File;

class MealsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $json = File::get(base_path("database/data/meals.json"));
        $data = json_decode($json);

        foreach ($data as $row) {
            Meal::create((array) $row);
        }
    }
}
