<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Meal;

class Restaurant extends Model
{

    protected $table = "restaurants";

    public function meals()
    {
        return $this->belongsToMany(Meal::class, "restaurants_meals", "restaurant_id", "meal_id")->withPivot("recommendations");
    }
}
