<?php

namespace App\Components;

use App\Models\Board;
use Config;

class GameMap
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
        $blankValue = Config::get('enums.field_types.empty');
        $gameMap = [];

        for ($i = 0; $i < $size; $i++) {
            for ($j = 0; $j < $size; $j++) {
                $gameMap[$i][$j] = $blankValue;
            }
        }

        return $gameMap;
    }

    /**
     * Check winner (only for 3x3 map)
     *
     * @param App\Models\Board $board
     * @param array $gameMap
     * @param int $playerType
     *
     * @return bool
     */
    public static function checkWinner(array $gameMap, int $playerType)
    {
        $combinations = [
            // horizontal combionations
            [[0, 0], [0, 1], [0, 2]],
            [[1, 0], [1, 1], [2, 2]],
            [[2, 0], [2, 1], [2, 2]],
            // vertical combinations
            [[0, 0], [1, 0], [2, 0]],
            [[0, 1], [1, 1], [2, 1]],
            [[0, 2], [1, 2], [2, 2]],
            // diagonal combinations
            [[0, 0], [1, 1], [2, 2]],
            [[2, 0], [1, 1], [0, 2]],
        ];

        foreach ($combinations as $key) {
            if ($gameMap[$key[0][0]][$key[0][1]] == $playerType &&
                $gameMap[$key[1][0]][$key[1][1]] == $playerType &&
                $gameMap[$key[2][0]][$key[2][1]] == $playerType
            ) {
                return true;
            }
        }
        return false;
    }
}
