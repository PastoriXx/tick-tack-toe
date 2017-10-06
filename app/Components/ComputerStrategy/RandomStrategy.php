<?php

namespace App\Components\ComputerStrategy;

use App\Components\GameMap;

class RandomStrategy extends Strategy implements StrategyInterface
{
    /**
     * Find for a random free cell
     *
     * @return array
     */
    public function findBestStep()
    {
        $blankCells = $this->findBlankCells();

        if (count($blankCells) == 0) {
            return ['errors' => 'Game over'];
        }

        shuffle($blankCells);
        $cell = $blankCells[0];

        $this->gameMap[$cell[0]][$cell[1]] = $this->computerType;

        return [
            'game_map' => $this->gameMap,
        ];
    }
}
