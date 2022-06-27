<?php

use PHPUnit\Framework\TestCase;

require_once(__DIR__ . '/../../lib/vending_machine/Snack.php');

class SnackTest extends TestCase
{
    public function testGetPrice()
    {
        $snack = new Snack();
        $this->assertSame(150, $snack->getPrice());
    }

    public function testGetName()
    {
        $snack = new Snack();
        $this->assertSame('potato chips', $snack->getName());
    }

    public function testGetCupNumber()
    {
        $snack = new Snack();
        $this->assertSame(0, $snack->getCupNumber());
    }
}
