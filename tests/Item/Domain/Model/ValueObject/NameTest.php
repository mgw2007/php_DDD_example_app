<?php

use PHPUnit\Framework\TestCase;
use Item\Domain\Model\Item\ValueObject\Name;

class NameTest extends TestCase
{
    public function testItShouldThrowExceptionForNotValue(): void
    {
        $this->expectException(InvalidArgumentException::class);
        new Name('');
    }

    public function testItShouldThrowExceptionForNoArguments(): void
    {
        $this->expectException(ArgumentCountError::class);
        new Name();
    }

    public function testItShouldSuccess(): void
    {
        $val = 'data';
        $name = new Name($val);
        $this->assertEquals($val, $name->get());
    }
}