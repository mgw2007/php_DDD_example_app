<?php

use PHPUnit\Framework\TestCase;
use Item\Domain\Model\Item\ValueObject\Difficulty;
class DifficultyTest extends TestCase
{
    public function testItShouldThrowExceptionForNoArguments(): void
    {
        $this->expectException(ArgumentCountError::class);
        new Difficulty();
    }

    public function testItShouldThrowExceptionForNotNumberValue(): void
    {
        $this->expectException(InvalidArgumentException::class);
        new Difficulty('notNumberValue');
    }

    public function testItShouldThrowExceptionNumberOutOfRange(): void
    {
        $this->expectException(InvalidArgumentException::class);
        new Difficulty(4);
    }

    public function testItShouldSuccess(): void
    {
        $val = 3;
        $difficulty = new Difficulty($val);
        $this->assertEquals($val,$difficulty->get());
    }
}