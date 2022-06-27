<?php
require_once(__DIR__ . '/Item.php');

class Snack extends Item
{
    public function __construct()
    {
        parent::__construct('potato chips');
    }

    public function getPrice(): int
    {
        return 150;
    }

    public function getCupNumber(): int
    {
        return 0;
    }
}
