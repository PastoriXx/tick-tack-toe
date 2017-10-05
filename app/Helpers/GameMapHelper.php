<?php

namespace App\Helpers;

use Config;

class GameMapHelper
{
    /**
     * Create initial map
     *
     * @param int $size
     *
     * @return array
     */
    public static function createInitialMap(int $size = 3)
    {
        $value = Config::get('enums.field_types.empty');
        $map = [];
 
        for($i = 0; $i < $size; $i++) {
            for($j = 0; $j < $size; $j++) {
                $map[$i][$j] = $value;
            }
        }
  
        return $map;
    }
}
