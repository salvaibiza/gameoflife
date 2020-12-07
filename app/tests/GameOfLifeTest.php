<?php

require __DIR__ . '/../../vendor/autoload.php';

use Application\src\GameOfLife;
use Application\src\GameOfLifeHelper;
use PHPUnit\Framework\TestCase;

class GameOfLifeTest extends TestCase
{

    /**
     * @dataProvider getBoardProvider
     * @param array $board
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
        return [
            [
                [
                    [0, 1, 1, 0],
                    [0, 0, 1, 1],
                    [0, 0, 1, 0],
                    [0, 0, 0, 0]
                ],
                [
                    [0, 1, 1, 1],
                    [0, 0, 0, 1],
                    [0, 0, 1, 1],
                    [0, 0, 0, 0]
                ]
            ],
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
        ];
    }

}