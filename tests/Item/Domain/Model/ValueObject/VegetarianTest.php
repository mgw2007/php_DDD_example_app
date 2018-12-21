<?php

use PHPUnit\Framework\TestCase;
use Item\Domain\Model\Item\ValueObject\Vegetarian;

class VegetarianTest extends TestCase
{
    public function testItShouldThrowExceptionForNoArguments(): void
    {
        $this->expectException(ArgumentCountError::class);
        new Vegetarian();
    }
    public function testItShouldThrowExceptionForNotNumberValue(): void
    {
        $this->expectException(InvalidArgumentException::class);
        new Vegetarian('NotBoolean');
    }


    public function testItShouldSuccess(): void
    {
        $val = true;
        $vegetarian = new Vegetarian($val);
        $this->assertEquals($val, $vegetarian->get());
    }
}