<?php

namespace App\Helpers;

use App\Models\Board;
use Config;
use Cookie;

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

    /**
     * Update map
     *
     * @param array $boardId
     *
     * @return bool
     */
    public static function updateMap(int $boardId) 
    {
        return [];
    }

    /**
     * Check user access
     *
     * @param int $boardId
     *
     * @return bool
     */
    public static function checkAccess(int $boardId) 
    {
        return Board::where('id', $boardId)
            ->where('player_token', Cookie::get('user_token'))
            ->exists();
    }
}
