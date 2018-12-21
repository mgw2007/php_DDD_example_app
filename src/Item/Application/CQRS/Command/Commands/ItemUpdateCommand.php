<?php

namespace Item\Application\CQRS\Command\Commands;

use Assert\Assertion;
use Item\Application\CQRS\Command\CommandInterface;
use Item\Domain\Model\Item\Item;
use Item\Domain\Model\Item\ValueObject;

class ItemUpdateCommand implements CommandInterface
{
    private $item;

    public function __construct(string $itemId, array $data)
    {
        Assertion::keyIsset($data, 'name','name is missing');
        Assertion::keyIsset($data, 'propTime','propTime is missing');
        Assertion::keyIsset($data, 'difficulty','difficulty is missing');
        Assertion::keyIsset($data, 'vegetarian','vegetarian is missing');
        $this->item = new Item(
            ValueObject\ItemId::fromString($itemId),
            new ValueObject\Name($data['name']),
            new ValueObject\PropTime($data['propTime']),
            new ValueObject\Difficulty($data['difficulty']),
            new ValueObject\Vegetarian($data['vegetarian'])
        );
    }

    public function getItem(): Item
    {
        return $this->item;
    }
}