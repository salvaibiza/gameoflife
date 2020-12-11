<?php

namespace Application\src;

use Application\src\helpers\BoardOutput;
use Application\src\helpers\GameOfLifeHelper;
use Application\src\models\Board;
use Application\src\models\Cell;

class GameOfLife
{
    const ALIVE_CELL = 1;
    const DEAD_CELL = 0;
    const MAX_POPULATION = 3;
    const MIN_POPULATION = 2;

    /**@var Board $board  **/
    private $board;

    /**@var $gen int **/
    private $gen = 0;

    /**
     * GameOfLife constructor.
     * @param Board $board
     */
    public function __construct(Board $board)
    {
        $this->board = $board;
        $this->getOutputHandler()->printBoard($board, $this->gen);
    }

    public function nextGen()
    {
        $board = $this->board;
        $numRows = $board->getNumRows();
        $numCols = $board->getNumColumns();
        $nextGenBoard = new Board($numRows, $numCols);

        for ($r = 0; $r < $numRows; $r++) {
            for ($c = 0; $c < $numCols; $c++) {
                if ($cell = $board->getCell($r, $c)) {
                    $newState = $this->getNextStatus($r, $c);
                    $newCell = new Cell($newState);
                    $nextGenBoard->addCell($newCell, $r, $c);
                }
            }
        }
        $this->board = $nextGenBoard;

        $this->getOutputHandler()->printBoard($nextGenBoard, ++$this->gen);

        return $nextGenBoard;
    }

    /**
     * @param int $row
     * @param int $col
     * @return int
     */
    private function getNextStatus($row, $col)
    {
        $status = self::DEAD_CELL;

        $helper = $this->getHelper();
        try {
            $cell = $this->board->getCell($row, $col);

            if ($cell instanceof Cell) {
                $status = $cell->getState();

                if ($helper->isCellAliveAndHasLessMinPopulation($cell, $row, $col) ||
                    $helper->isCellAliveAndHasMoreMaxPopulation($cell, $row, $col)) {
                    $status = self::DEAD_CELL;
                } elseif ($helper->isCellDeadAndHasMaxPopulation($cell, $row, $col)) {
                    $status = self::ALIVE_CELL;
                }
            }
        } catch (\Exception $e) { }

        return $status;
    }

    private function getHelper()
    {
        return new GameOfLifeHelper($this->board);
    }

    private function getOutputHandler()
    {
        return new BoardOutput();
    }
}