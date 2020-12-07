<?php


namespace Application\src\helpers;


use Application\src\GameOfLife;

class BoardGenerator
{

    /**
     * @param int $rows
     * @param int $columns
     * @return array
     */
    public function generateRandomInitialBoard($rows, $columns)
    {
        $board = [];

        if (is_numeric($rows) && is_numeric($columns)) {
            for($r = 0; $r < $rows; $r++) {
                for($c = 0; $c < $columns; $c++) {
                    try {
                        $board[$r][$c] = random_int(GameOfLife::DEAD_CELL, GameOfLife::ALIVE_CELL);
                    } catch (\Exception $e) { }
                }
            }
        }

        return $board;
    }
}