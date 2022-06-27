<?php

class PokerGame
{
    function __construct(private array $card1, private array $card2)
    {
    }
    function start():array
    {
        return [$this->card1, $this->card2];
    }
}
