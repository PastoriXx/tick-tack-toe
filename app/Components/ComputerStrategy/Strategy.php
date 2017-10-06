<?php

namespace App\Components\ComputerStrategy;

use Config;

class Strategy
{
    public $gameMap;
    public $computerType;

    public function __construct(array $gameMap, int $computerType)
    {
        $this->gameMap = $gameMap;
        $this->computerType = $computerType;
    }


    /**
     * Find a blank cells
     *
     * @return int $field
     */
    public function findBlankCells()
    {
        $blankValue = Config::get('enums.field_types.empty');
        $cells = [];
        
        foreach ($this->gameMap as $i => $row) {
            foreach ($row as $j => $value) {
                if ($value == $blankValue) {
                    $cells[] = [$i, $j];
                }
            }
        }
        return $cells;
    }
}
