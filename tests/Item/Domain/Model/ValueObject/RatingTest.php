<?php

use PHPUnit\Framework\TestCase;
use Item\Domain\Model\Item\ValueObject\Rating;
class RatingTest extends TestCase
{
    public function testItShouldThrowExceptionForNoArguments(): void
    {
        $this->expectException(ArgumentCountError::class);
        new Rating();
    }
    public function testItShouldThrowExceptionForNotNumberValue(): void
    {
        $this->expectException(InvalidArgumentException::class);
        new Rating('notNumberValue');
    }

    public function testItShouldThrowExceptionNumberOutOfRange(): void
    {
        $this->expectException(InvalidArgumentException::class);
        new Rating(8);
    }

    public function testItShouldSuccess(): void
    {
        $val = 3;
        $Rating = new Rating($val);
        $this->assertEquals($val,$Rating->get());
    }
}