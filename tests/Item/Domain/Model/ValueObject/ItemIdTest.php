<?php

use PHPUnit\Framework\TestCase;
use Item\Domain\Model\Item\ValueObject\ItemId;
use Ramsey\Uuid\Uuid;

class ItemIdTest extends TestCase
{

    public function testItShouldThrowExceptionForNotUUID(): void
    {
        $this->expectException(InvalidArgumentException::class);
        ItemId::fromString('NotUUID');
    }

    public function testItShouldWork(): void
    {
        $uuid  = (string)Uuid::uuid4();
        $ItemId = ItemId::fromString($uuid);
        $this->assertEquals($uuid,$ItemId->toString());
    }

}