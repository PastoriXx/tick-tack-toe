<?php

namespace App\Components\ComputerStrategy;

interface StrategyInterface
{
    /**
     * Find the best free cell
     *
     * @return array
     */
    public function findBestStep();
}