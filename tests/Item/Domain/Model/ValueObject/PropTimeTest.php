<?php

use PHPUnit\Framework\TestCase;

use Item\Domain\Model\Item\ValueObject\PropTime;

class PropTimeTest extends TestCase
{
    public function testItShouldThrowExceptionForNoArguments(): void
    {
        $this->expectException(ArgumentCountError::class);
        new PropTime();
    }
    public function testItShouldThrowExceptionForNotNumberValue(): void
    {
        $this->expectException(InvalidArgumentException::class);
        new PropTime('notNumberValue');
    }

    public function testItShouldThrowExceptionNumberOutOfRagne(): void
    {
        $this->expectException(InvalidArgumentException::class);
        new PropTime('55:55');
    }

    public function testItShouldSuccess(): void
    {
        $val = '02:00';
        $propTime = new PropTime($val);
        $this->assertEquals($val,$propTime->get());
    }
}