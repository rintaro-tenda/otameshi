<?php

use PHPUnit\Framework\TestCase;

require_once(__DIR__ . "/../../lib/poker/PokerGame.php");

class PokerGameTest extends TestCase
{
    function testStart()
    {
        // $game = new PokerGame(['CA', 'DA']);
        // $this->assertSame(['CA', 'DA'], $game->start());

        // 仕様変更、二人に変更
        $game = new PokerGame(['CA', 'DA'], ['C10', 'H10']);
        $this->assertSame([['CA', 'DA'], ['C10', 'H10']], $game->start());
    }
}
