<?php


namespace Application\src\helpers;

use Application\src\models\Board;
use Application\src\models\Cell;

class BoardGenerator
{

    /**
     * @param int $rows
     * @param int $columns
     * @return Board
     */
    public function generateRandomInitialBoard($rows, $columns)
    {
        $board = null;

        if (is_numeric($rows) && is_numeric($columns)) {
            $board = new Board($rows, $columns);

            for($r = 0; $r < $rows; $r++) {
                for($c = 0; $c < $columns; $c++) {
                    try {
                        $state = random_int(Cell::DEAD_CELL, Cell::ALIVE_CELL);
                        $cell = new Cell($state);
                        $board->addCell($cell, $r, $c);
                    } catch (\Exception $e) { }
                }
            }
        }

        return $board;
    }
}