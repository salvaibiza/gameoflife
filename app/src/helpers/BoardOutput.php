<?php


namespace Application\src\helpers;


use Application\src\models\Board;
use Application\src\models\Cell;

class BoardOutput
{

    /**
     * @param $board[][]
     * @param int $g
     */
    public function printBoard(Board $board, $g = 0)
    {
        echo "\nGeneration #{$g}\n";
        $cells = $board->getCells();
        foreach ($cells as $rowIndex => $rows) {

            foreach ($rows as $colIndex => $cell) {
                /**@var Cell $cell **/
                echo intval($cell->getState()) . " ";
            }
            echo "\n";
        }
    }

}