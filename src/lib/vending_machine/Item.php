<?php

abstract class Item
{
    abstract public function getPrice();
    abstract public function getCupNumber();

    public function __construct(protected string $name)
    {
    }

    public function getName(): string
    {
        return $this->name;
    }
}
