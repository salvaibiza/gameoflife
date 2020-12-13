<?php

namespace Application\src\helpers;

use Application\src\GameOfLife;
use Application\src\models\Board;
use Application\src\models\Cell;

class GameOfLifeHelper
{
    /**@var Board $board **/
    private $board;

    /**
     * GameOfLifeHelper constructor.
     * @param Board $board
     */
    public function __construct(Board $board)
    {
        $this->board = $board;
    }

    /**
     * Any dead cell with exactly three live neighbours becomes a live cell, as if by reproduction
     * @param Cell $cell
     * @param int $row
     * @param int $col
     * @return bool
     */
    public function isCellDeadAndHasMaxPopulation(Cell $cell, $row, $col)
    {
        return $cell->isDead()
            && $this->getNumNearCellsAlive($row, $col) == GameOfLife::MAX_POPULATION;
    }

    /**
     * Any live cell with fewer than two live neighbours dies, as if caused by under-population
     * @param Cell $cell
     * @param int $row
     * @param int $col
     * @return bool
     */
    public function isCellAliveAndHasLessMinPopulation(Cell $cell, $row, $col)
    {
        return $cell->isAlive()
            && $this->getNumNearCellsAlive($row, $col) < GameOfLife::MIN_POPULATION;
    }

    /**
     * Any live cell with more than three live neighbours dies, as if by overcrowding
     * @param Cell $cell
     * @param int $row
     * @param int $col
     * @return bool
     */
    public function isCellAliveAndHasMoreMaxPopulation(Cell $cell, $row, $col)
    {
        return $cell->isAlive()
            && $this->getNumNearCellsAlive($row, $col) > GameOfLife::MAX_POPULATION;
    }

    /**
     * @param int $row
     * @param int $col
     * @return int
     */
    public function getNumNearCellsAlive($row, $col)
    {
        $board = $this->board;

        $previousRowIndex = $row-1;
        $alive = $this->countCellsAliveInRow($previousRowIndex, $col);

        try {
            $cellPreviousCol = $board->getCell($row, $col - 1);
            if ($cellPreviousCol->isAlive()) {
                $alive++;
            }
        } catch (\Exception $e) { }

        try {
            $cellNextCol = $board->getCell($row, $col + 1);
            if ($cellNextCol->isAlive()) {
                $alive++;
            }
        } catch (\Exception $e) { }

        $nextRowIndex = $row+1;
        $alive += $this->countCellsAliveInRow($nextRowIndex, $col);

        return $alive;
    }

    /**
     * @param int $row
     * @param int $col
     * @return int
     */
    public function countCellsAliveInRow($row, $col)
    {
        $alive = 0;
        $board = $this->board;
        try {
            $cell = $board->getCell($row, $col);
            if ($cell->isAlive()) {
                $alive++;
            }
        } catch (\Exception $e) { }

        try {
            $cellPreviousCol = $board->getCell($row, $col - 1);
            if ($cellPreviousCol->isAlive()) {
                $alive++;
            }
        } catch (\Exception $e) { }

        try {
            $cellNextCol = $board->getCell($row, $col + 1);
            if ($cellNextCol->isAlive()) {
                $alive++;
            }
        } catch (\Exception $e) { }

        return $alive;
    }

}