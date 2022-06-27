<?php

use PHPUnit\Framework\TestCase;

require_once(__DIR__ . '/../../lib/vending_machine/Drink.php');

class DrinkTest extends TestCase
{
    public function testGetPrice()
    {
        $drink = new Drink("cola");
        $this->assertSame(150, $drink->getPrice());
    }

    public function testGetName()
    {
        $drink = new Drink("cola");
        $this->assertSame("cola", $drink->getName());
    }

    public function testGetCupNumber()
    {
        $drink = new Drink("cola");
        $this->assertSame(0, $drink->getCupNumber());
    }
}
