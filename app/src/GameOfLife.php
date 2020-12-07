<?php

namespace Application\src;

use Application\src\helpers\GameOfLifeHelper;

class GameOfLife
{
    const ALIVE_CELL = 1;
    const DEAD_CELL = 0;
    const MAX_POPULATION = 3;
    const MIN_POPULATION = 2;

    /**@var $board [][] **/
    private $board;

    /**@var $colCount int **/
    private $colCount;

    /**@var $rowCount int **/
    private $rowCount;

    /**@var $gen int **/
    private $gen = 0;

    /**
     * GameOfLife constructor.
     * @param $board[][]
     */
    public function __construct($board)
    {
        $this->initialize($board);

        $this->getHelper()->printBoard($board, $this->gen);
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
     * @return array
     */
    public function nextGen()
    {
        $nextGenBoard = [];
        for ($r = 0; $r < $this->rowCount; $r++) {
            for ($c = 0; $c < $this->colCount; $c++) {
                $nextGenBoard[$r][$c] = $this->getNextStatus($r, $c);
            }
        }
        $this->getHelper()->printBoard($nextGenBoard, ++$this->gen);
        $this->board = $nextGenBoard;

        return $nextGenBoard;
    }

    /**
     * @param int $row
     * @param int $col
     * @return int
     */
    private function getNextStatus($row, $col)
    {
        $helper = $this->getHelper();
        $status = $this->board[$row][$col];
        if ($helper->isCellAliveAndHasLessMinPopulation($row, $col) ||
            $helper->isCellAliveAndHasMoreMaxPopulation($row, $col)) {
            $status = self::DEAD_CELL;
        } elseif($helper->isCellDeadAndHasMaxPopulation($row, $col)) {
            $status = self::ALIVE_CELL;
        }
        return $status;
    }

    private function getHelper()
    {
        return new GameOfLifeHelper($this->board);
    }
}