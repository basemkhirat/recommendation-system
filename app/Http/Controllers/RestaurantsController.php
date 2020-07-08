<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Restaurant;
use Illuminate\Support\Facades\DB;
use App\Services\Rank;

class RestaurantsController extends Controller
{

    /**
     * Find top three restaurants
     */
    function index()
    {

        // Default values
        $restaurants = [];
        $latitude = 30.003425;
        $longitude = 31.431724;

        if (request()->isMethod("POST")) {
            $validator = validator()->make(request()->all(), [
                "meal_name" => "required",
                "latitude" => "required",
                "longitude" => "required",
            ]);

            if ($validator->fails()) {
                return redirect()->back()->withErrors($validator)->withInput();
            }

            $meal_name = request("meal_name");
            $latitude = request("latitude");
            $longitude = request("longitude");

            $query = Restaurant::take(3);

            $query->select(
                "restaurants.id",
                "restaurants.name",
                "restaurants.latitude",
                "restaurants.longitude",
                "restaurants.recommendations",
                "restaurants_meals.recommendations as meal_recommendations",
                "meals.name as meal_name",
                "restaurants.name",
                "restaurants.name",
            );

            $query->selectRaw("(3959 * ACOS(COS(RADIANS($latitude))
            * COS(RADIANS(latitude))
            * COS(RADIANS($longitude) - RADIANS(longitude))
            + SIN(RADIANS($latitude))
            * SIN(RADIANS(latitude)))) AS distance");

            $query->join("restaurants_meals", "restaurants_meals.restaurant_id", "=", "restaurants.id");
            $query->join("meals", "restaurants_meals.meal_id", "=", "meals.id");
            $query->where("meals.name", "like", '%' . $meal_name . '%');

            $ranked_restaurants = new Rank($query->get()->map(function ($row) {
                return [
                    "id" => $row->id,
                    "name" => $row->name,
                    "recommendations" => $row->recommendations,
                    "orders" => $row->orders,
                    "distance" => $row->distance,
                    "meal_name" => $row->meal_name,
                    "meal_recommendations" => $row->meal_recommendations
                ];
            })->toArray());

            $restaurants = $ranked_restaurants->sort();
        }

        return view("restaurants", [
            "latitude" => $latitude,
            "longitude" => $longitude,
            "restaurants" => $restaurants
        ]);
    }
}
