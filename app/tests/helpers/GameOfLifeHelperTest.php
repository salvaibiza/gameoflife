<?php

require __DIR__ . '/../../../vendor/autoload.php';

use Application\src\GameOfLife;
use Application\src\helpers\GameOfLifeHelper;
use PHPUnit\Framework\TestCase;

class GameOfLifeHelperTest extends TestCase
{

    /**
     * @var GameOfLife
     */
    private static $sut;

    public static function setUpBeforeClass(): void
    {
        $board = self::getBoardMock();
        self::$sut = new GameOfLifeHelper($board);
    }

    private static function getBoardMock()
    {
        return [
            [0, 1, 1, 0],
            [0, 0, 1, 1],
            [0, 0, 1, 0],
            [0, 0, 0, 0]
        ];
    }

    /**
     * @param int $r
     * @param int $c
     * @param int $expectedStatus
     * @dataProvider rowAndColumnIndexProviderStatus
     */
    public function testIsCellAlive($r, $c, $expectedStatus)
    {
        $res = self::$sut->isCellAlive($r, $c);
        $this->assertEquals($res, $expectedStatus);
    }

    public function rowAndColumnIndexProviderStatus()
    {
        return [
            [0, 0, GameOfLife::DEAD_CELL],
            [1, 0, GameOfLife::DEAD_CELL],
            [2, 2, GameOfLife::ALIVE_CELL],
            [3, 1, GameOfLife::DEAD_CELL],
            [99, 1, GameOfLife::DEAD_CELL],
            [3, 99, GameOfLife::DEAD_CELL],
            [99, 99, GameOfLife::DEAD_CELL],
        ];
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
            [99, 00, 0],
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