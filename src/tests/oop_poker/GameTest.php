<?php

use PHPUnit\Framework\TestCase;

require_once(__DIR__ . '/../../lib/oop_poker/Game.php');

class GameTest extends TestCase
{
    public function testStart()
    {
        $game = new Game("田中", 2);
        $results = $game->start();
        $this->assertSame(2, count($results));
    }
}
