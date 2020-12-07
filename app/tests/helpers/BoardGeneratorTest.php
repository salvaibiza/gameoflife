<?php

require __DIR__ . '/../../../vendor/autoload.php';

use Application\src\helpers\BoardGenerator;
use PHPUnit\Framework\TestCase;

class BoardGeneratorTest extends TestCase
{

    public function testGenerateRandomInitialBoard()
    {
        $sut = new BoardGenerator();
        $board = $sut->generateRandomInitialBoard(5, 7);
        $this->assertIsArray($board);
        $this->assertIsArray($board[0]);
        $this->assertCount(5, $board);
        $this->assertCount(7, $board[0]);
    }

}