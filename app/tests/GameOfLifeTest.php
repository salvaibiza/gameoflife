<?php

require __DIR__ . '/../../vendor/autoload.php';

use Application\src\GameOfLife;
use Application\src\models\Board;
use Application\src\models\Cell;
use PHPUnit\Framework\TestCase;

class GameOfLifeTest extends TestCase
{

    /**
     * @dataProvider getBoardProvider
     * @param Board $board
     * @param array $nextBoardExpected
     */
    public function testNextGen($board, $nextBoardExpected)
    {
        $this->markTestSkipped("Requires nextGen() returns nextGeneration board");
        $game = new GameOfLife($board);
        $result = $game->nextGen();
        $this->assertEquals($nextBoardExpected, $result);
    }

    public function getBoardProvider()
    {
        //TODO: update test
        $board = new Board(4, 4);
        $board->addCell(new Cell(Cell::DEAD_CELL), 0,0);
        $board->addCell(new Cell(Cell::ALIVE_CELL), 0,1);
        $board->addCell(new Cell(Cell::ALIVE_CELL), 0,2);
        $board->addCell(new Cell(Cell::DEAD_CELL), 0,3);

        $board->addCell(new Cell(Cell::DEAD_CELL), 1,0);
        $board->addCell(new Cell(Cell::DEAD_CELL), 1,1);
        $board->addCell(new Cell(Cell::ALIVE_CELL), 1,2);
        $board->addCell(new Cell(Cell::ALIVE_CELL), 1,3);

        $board->addCell(new Cell(Cell::DEAD_CELL), 2,0);
        $board->addCell(new Cell(Cell::DEAD_CELL), 2,1);
        $board->addCell(new Cell(Cell::ALIVE_CELL), 2,2);
        $board->addCell(new Cell(Cell::DEAD_CELL), 2,3);

        $board->addCell(new Cell(Cell::DEAD_CELL), 3,0);
        $board->addCell(new Cell(Cell::DEAD_CELL), 3,1);
        $board->addCell(new Cell(Cell::DEAD_CELL), 3,2);
        $board->addCell(new Cell(Cell::DEAD_CELL), 3,3);

        $boardGen1 = new Board(4, 4);
        $boardGen1->addCell(new Cell(Cell::DEAD_CELL), 0,0);
        $boardGen1->addCell(new Cell(Cell::ALIVE_CELL), 0,1);
        $boardGen1->addCell(new Cell(Cell::ALIVE_CELL), 0,2);
        $boardGen1->addCell(new Cell(Cell::ALIVE_CELL), 0,3);

        $boardGen1->addCell(new Cell(Cell::DEAD_CELL), 1,0);
        $boardGen1->addCell(new Cell(Cell::DEAD_CELL), 1,1);
        $boardGen1->addCell(new Cell(Cell::DEAD_CELL), 1,2);
        $boardGen1->addCell(new Cell(Cell::ALIVE_CELL), 1,3);

        $boardGen1->addCell(new Cell(Cell::DEAD_CELL), 2,0);
        $boardGen1->addCell(new Cell(Cell::DEAD_CELL), 2,1);
        $boardGen1->addCell(new Cell(Cell::ALIVE_CELL), 2,2);//
        $boardGen1->addCell(new Cell(Cell::ALIVE_CELL), 2,3);

        $boardGen1->addCell(new Cell(Cell::DEAD_CELL), 3,0);
        $boardGen1->addCell(new Cell(Cell::DEAD_CELL), 3,1);
        $boardGen1->addCell(new Cell(Cell::DEAD_CELL), 3,2);
        $boardGen1->addCell(new Cell(Cell::DEAD_CELL), 3,3);

        return [
            [
                $board,
                $boardGen1
            ],
            /**
             * WIP
            [
            [
            [0, 1, 1, 1],
            [0, 0, 0, 1],
            [0, 0, 1, 1],
            [0, 0, 0, 0]
            ],

            [
            [0, 0, 1, 1],
            [0, 1, 0, 0],
            [0, 0, 1, 1],
            [0, 0, 0, 0]
            ]
            ],
            [
            [
            [0, 0, 1, 1],
            [0, 1, 0, 0],
            [0, 0, 1, 1],
            [0, 0, 0, 0]
            ],

            [
            [0, 0, 1, 0],
            [0, 1, 0, 0],
            [0, 0, 1, 0],
            [0, 0, 0, 0]
            ]
            ]
             **/
        ];
    }

}