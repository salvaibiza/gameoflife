<?php

require __DIR__ . '/../../../vendor/autoload.php';

use Application\src\GameOfLife;
use Application\src\helpers\GameOfLifeHelper;
use Application\src\models\Board;
use Application\src\models\Cell;
use PHPUnit\Framework\TestCase;

class GameOfLifeHelperTest extends TestCase
{

    /**
     * @var GameOfLifeHelper
     */
    private static $sut;

    public static function setUpBeforeClass(): void
    {
        $board = self::getBoardMock();
        self::$sut = new GameOfLifeHelper($board);
    }

    private static function getBoardMock()
    {
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

        return $board;
    }

    /**
     * @param $row
     * @param $col
     * @param $expectedResult
     * @dataProvider rowAndColumnIndexProviderCount
     */
    public function testGetNumNearCellsAlive($row, $col, $expectedResult)
    {
        $res = self::$sut->getNumNearCellsAlive($row, $col);
        $this->assertEquals($expectedResult, $res);
    }

    public function rowAndColumnIndexProviderCount()
    {
        return [
            [0, 0, 1],
            [1, 0, 1],
            [2, 2, 2],
            [3, 1, 1],
            [99, 99, 0],
        ];
    }

    /**
     * @dataProvider rowAndColumnIndexProviderRowCount
     * @param int $row
     * @param int $col
     * @param int $expectedCount
     */
    public function testCountCellsAliveInRow($row, $col, $expectedCount)
    {
        $res = self::$sut->countCellsAliveInRow($row, $col);
        $this->assertEquals($expectedCount, $res);
    }

    public function rowAndColumnIndexProviderRowCount()
    {
        return [
            [0, 1, 2],
            [1, 0, 0],
            [1, 1, 1],
            [3, 1, 0],
            [99, 99, 0]
        ];
    }

}