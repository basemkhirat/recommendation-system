<?php

namespace Tests\Unit;

use App\Services\Rank;
use PHPUnit\Framework\TestCase;

class RankTest extends TestCase
{
    /**
     * Test Rank Calculation.
     *
     * @return void
     */
    public function testRankCalculation()
    {
        $restaurant = [
            "id" => 1,
            "name" => "KFC",
            "recommendations" =>  5,
            "orders" =>  100,
            "distance" => "30.00123700",
            "meal_name" => "salad",
            "meal_recommendations" => 12,
        ];

        $rank = Rank::calculate($restaurant);

        $this->assertEquals(
            260.98763,
            $rank,
            "actual value is not equal to expected"
        );
    }

    /**
     * Test sorted restaurants.
     *
     * @return void
     */
    public function testSortedRestaurants()
    {
        $restaurants = [
            [
                "id" => 1,
                "name" => "KFC",
                "recommendations" =>  5,
                "orders" =>  100,
                "distance" => 30.00123700,
                "meal_name" => "salad",
                "meal_recommendations" => 12
            ],
            [

                "id" => 2,
                "name" => "Cookdoor",
                "recommendations" => 10,
                "orders" =>  40,
                "distance" => 29.99399400,
                "meal_name" => "salad",
                "meal_recommendations" => 12
            ],
            [

                "id" => 3,
                "name" => "Spectra",
                "recommendations" => 15,
                "orders" =>  35,
                "distance" => 30.00530200,
                "meal_name" => "salad",
                "meal_recommendations" => 19
            ]
        ];

        $expected_restaurants = [
            [
                "id" => 1,
                "name" => "KFC",
                "recommendations" =>  5,
                "orders" =>  100,
                "distance" => 30.00123700,
                "meal_name" => "salad",
                "meal_recommendations" => 12,
                "rank" => 260.98763
            ],
            [

                "id" => 2,
                "name" => "Cookdoor",
                "recommendations" => 10,
                "orders" =>  40,
                "distance" => 29.99399400,
                "meal_name" => "salad",
                "meal_recommendations" => 12,
                "rank" => -13.93994
            ],
            [

                "id" => 3,
                "name" => "Spectra",
                "recommendations" => 15,
                "orders" =>  35,
                "distance" => 30.00530200,
                "meal_name" => "salad",
                "meal_recommendations" => 19,
                "rank" => 6.94698
            ]
        ];


        $ranked_restaurants = new Rank($restaurants);

        $sorted_restaurants = $ranked_restaurants->sort();

        $this->assertEqualsArrays($sorted_restaurants, $expected_restaurants, "Sorted restaurants is not equal to expected");
    }

    protected function assertEqualsArrays($expected, $actual, $message) {
        sort($expected);
        sort($actual);
        $this->assertEquals($expected, $actual, $message);
    }

}
