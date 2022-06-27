<?php

require_once('Deck.php');
require_once('Player.php');

class Game
{
    function __construct(private string $name)
    {

    }
    function start()
    {
        $deck = new Deck();
        // プレイヤーを登録する
        $player = new Player($this->name);
        // プレイヤーがカードを引く
        $cards = $player->drawCards($deck , $this->drawNum);
        return $cards;
    }
}
