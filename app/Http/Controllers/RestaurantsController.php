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

            $query->select(DB::raw('*, ( 6367 * acos( cos( radians(' . $latitude . ') ) * cos( radians( latitude ) ) * cos( radians( longitude ) - radians(' . $longitude . ') ) + sin( radians(' . $latitude . ') ) * sin( radians( latitude ) ) ) ) AS distance'));

            $query->with(["meals" => function ($query) use ($meal_name) {
                $query->where("meals.name", "like", '%' . $meal_name . '%');
            }]);

            if (request()->filled("meal_name")) {
                $query->whereHas("meals", function ($query) use ($meal_name) {
                    $query->where("meals.name", "like", '%' . $meal_name . '%');
                });
            }

            $ranked_restaurants = new Rank($query->get()->map(function ($row) {
                return [
                    "id" => $row->id,
                    "name" => $row->name,
                    "recommendations" => $row->recommendations,
                    "orders" => $row->orders,
                    "distance" => $row->distance,
                    "meal_name" => $row->meals->first()->name,
                    "meal_recommendations" => $row->meals->first()->pivot->recommendations
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
