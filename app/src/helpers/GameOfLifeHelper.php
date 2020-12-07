<?php

namespace Application\src\helpers;

use Application\src\GameOfLife;

class GameOfLifeHelper
{
    /**@var $board [][] **/
    private $board;

    /**@var $colCount int **/
    private $colCount;

    /**@var $rowCount int **/
    private $rowCount;

    /**
     * GameOfLifeHelper constructor.
     * @param $board[][]
     */
    public function __construct($board = [])
    {
        $this->initialize($board);
    }

    /**
     * @param $board[][]
     */
    private function initialize($board)
    {
        $this->board = $board;
        $this->rowCount = count($board);
        $this->colCount = count($board[0]);
    }

    /**
     * Any dead cell with exactly three live neighbours becomes a live cell, as if by reproduction
     * @param int $row
     * @param int $col
     * @return bool
     */
    public function isCellDeadAndHasMaxPopulation($row, $col)
    {
        return $this->isCellDead($row, $col)
            && $this->getNumNearCellsAlive($row, $col) == GameOfLife::MAX_POPULATION;
    }

    /**
     * Any live cell with fewer than two live neighbours dies, as if caused by under-population
     * @param $row
     * @param $col
     * @return bool
     */
    public function isCellAliveAndHasLessMinPopulation($row, $col)
    {
        return $this->isCellAlive($row, $col)
            && $this->getNumNearCellsAlive($row, $col) < GameOfLife::MIN_POPULATION;
    }

    /**
     * Any live cell with more than three live neighbours dies, as if by overcrowding
     * @param int $row
     * @param int $col
     * @return bool
     */
    public function isCellAliveAndHasMoreMaxPopulation($row, $col)
    {
        return $this->isCellAlive($row, $col)
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

        if (isset($board[$row][$col-1]) && $this->isCellAlive($row, $col-1)) {
            $alive++;
        }

        if (isset($board[$row][$col+1]) && $this->isCellAlive($row, $col+1)) {
            $alive++;
        }

        $nextRowIndex = $row+1;
        $alive += $this->countCellsAliveInRow($nextRowIndex, $col);

        return $alive;
    }

    /**
     * @param int $row
     * @param int $column
     * @return bool
     */
    public function isCellAlive($row, $column)
    {
        return $this->isCell($row, $column, GameOfLife::ALIVE_CELL);
    }

    /**
     * @param int $row
     * @param int $column
     * @return bool
     */
    public function isCellDead($row, $column)
    {
        return $this->isCell($row, $column, GameOfLife::DEAD_CELL);
    }

    /**
     * @param int $row
     * @param int $column
     * @param int $status
     * @return bool
     */
    private function isCell($row, $column, $status)
    {
        return (isset($this->board[$row][$column]) && $this->board[$row][$column] == $status);
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
        if (isset($board[$row])) {
            if ($this->isCellAlive($row, $col)) {
                $alive++;
            }
            if ($this->isCellAlive($row, $col - 1)) {
                $alive++;
            }
            if ($this->isCellAlive($row, $col + 1)) {
                $alive++;
            }
        }
        return $alive;
    }

    /**
     * @param $board[][]
     * @param int $g
     */
    public function printBoard($board, $g = 0)
    {
        echo "\nGeneration #{$g}\n";
        foreach ($board as $rowIndex => $rows) {
            echo implode(" ", $rows) . "\n";
        }
    }
}