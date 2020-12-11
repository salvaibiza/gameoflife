<?php

require __DIR__ . '/../../../vendor/autoload.php';

use Application\src\helpers\BoardGenerator;
use Application\src\models\Board;
use PHPUnit\Framework\TestCase;

class BoardGeneratorTest extends TestCase
{

    public function testGenerateRandomInitialBoard()
    {
        $sut = new BoardGenerator();
        $board = $sut->generateRandomInitialBoard(5, 7);
        $this->assertInstanceOf(Board::class, $board);
        $this->assertEquals(5, $board->getNumRows());
        $this->assertEquals(7, $board->getNumColumns());
    }

}