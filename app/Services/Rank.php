<?php

namespace App\Services;

class Rank
{

    public $rows = [];

    /**
     * initialize records
     */
    public function __construct($rows)
    {
        foreach ($rows as $row) {
            $row["rank"] = self::calculate($row);
            $this->rows[] = $row;
        }
    }

    /**
     * Calculate the rank
     */
    public static function calculate($row)
    {
        $result = -10 * $row["distance"]
            + 5 * $row["recommendations"]
            + 3 * $row["meal_recommendations"]
            + 5 * $row["orders"];

        return $result;
    }

    /**
     * Sort rows based on rank
     */
    public function sort()
    {
        usort($this->rows, function ($a, $b) {
            return $b["rank"] - $a["rank"];
        });

        return $this->rows;
    }
}
