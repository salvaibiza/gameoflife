<?php

require __DIR__ . '/../../../vendor/autoload.php';

use Application\src\models\Cell;
use PHPUnit\Framework\TestCase;


class CellTest extends TestCase
{
    /**
     * @param Cell $cell
     * @param int $expectedStatus
     * @dataProvider cellProvider
     */
    public function testGetState(Cell $cell, $expectedStatus)
    {
        $this->assertEquals($expectedStatus, $cell->getState());
    }

    public function cellProvider()
    {
        return [
            [new Cell(Cell::DEAD_CELL), Cell::DEAD_CELL],
            [new Cell(Cell::ALIVE_CELL), Cell::ALIVE_CELL],
        ];
    }

    public function testIsAlive()
    {
        $cell = new Cell(Cell::ALIVE_CELL);
        $this->assertTrue($cell->isAlive());
    }

    public function testIsDead()
    {
        $cell = new Cell(Cell::DEAD_CELL);
        $this->assertTrue($cell->isDead());
    }

}