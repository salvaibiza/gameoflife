<?php

require __DIR__ . '/../../../vendor/autoload.php';

use Application\src\helpers\BoardGenerator;
use Application\src\models\Board;
use Application\src\models\Cell;
use PHPUnit\Framework\TestCase;


class BoardTest extends TestCase
{
    /**
     * @var $sut Board
     */
    private static $sut;

    public static function setUpBeforeClass() : void
    {
        $generator = new BoardGenerator();
        self::$sut = $generator->generateRandomInitialBoard(4, 5);
    }

    public function testNumRows()
    {
        $this->assertIsNumeric(self::$sut->getNumRows());
        $this->assertEquals(4, self::$sut->getNumRows());
    }

    public function testNumColumns()
    {
        $this->assertIsNumeric(self::$sut->getNumColumns());
        $this->assertEquals(5, self::$sut->getNumColumns());
    }

    public function testCells()
    {
        $this->assertIsArray(self::$sut->getCells());
    }

    public function testAddCell()
    {
        $this->assertNull(self::$sut->addCell(new Cell(Cell::ALIVE_CELL), 1, 1));
    }

    public function testAddCellException()
    {
        $this->expectException(Exception::class);
        self::$sut->addCell(new Cell(Cell::ALIVE_CELL), 99, 99);
    }
}