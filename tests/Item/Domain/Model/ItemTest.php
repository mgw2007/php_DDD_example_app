<?php

use PHPUnit\Framework\TestCase;
use Item\Domain\Model\Item\Item;
use Item\Domain\Model\Item\ValueObject;
use Ramsey\Uuid\Uuid;

class ItemTest extends TestCase
{
    public function testInvalidArguments()
    {
        $this->expectException(ArgumentCountError::class);
        $uuid = (string)Uuid::uuid4();
        new Item(
            ValueObject\ItemId::fromString($uuid),
            new ValueObject\Name('testName')
        );
    }
    public function testSetAndGetProps()
    {
        $uuid = ValueObject\ItemId::fromString((string)Uuid::uuid4());
        $name = new ValueObject\Name('testName');
        $propTime = new ValueObject\PropTime('20:20');
        $difficulty = new ValueObject\Difficulty(1);
        $vegetarian = new ValueObject\Vegetarian(true);
        $item = new Item(($uuid),$name,$propTime,$difficulty,$vegetarian);

        $this->assertEquals($uuid->toString(),$item->getItemId()->toString());
        $this->assertEquals($name->toString(),$item->getName()->toString());
        $this->assertEquals($propTime->toString(),$item->getPropTime()->toString());
        $this->assertEquals($difficulty->toString(),$item->getDifficulty()->toString());
        $this->assertEquals($vegetarian->toString(),$item->getVegetarian()->toString());
    }

    public function testRate()
    {
        $uuid = ValueObject\ItemId::fromString((string)Uuid::uuid4());
        $name = new ValueObject\Name('testName');
        $propTime = new ValueObject\PropTime('20:20');
        $difficulty = new ValueObject\Difficulty(1);
        $vegetarian = new ValueObject\Vegetarian(true);
        $item = new Item(($uuid),$name,$propTime,$difficulty,$vegetarian);
        $item->addRating(new ValueObject\Rating(1));
        $item->addRating(new ValueObject\Rating(3));

        $this->assertEquals(2,count($item->getRatings()));
        $this->assertEquals(1,$item->getRatings()[0]->get());
        $this->assertEquals(3,$item->getRatings()[1]->get());
    }



}