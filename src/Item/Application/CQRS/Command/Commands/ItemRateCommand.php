<?php

namespace Item\Application\CQRS\Command\Commands;

use Assert\Assertion;
use Item\Application\CQRS\Command\CommandInterface;
use Item\Domain\Model\Item\Item;
use Item\Domain\Model\Item\ValueObject;

class ItemRateCommand implements CommandInterface
{
    private $itemId;
    private $rating;

    public function __construct(string $itemId, array $data)
    {
        Assertion::keyIsset($data, 'rating','rating is missing');

        $this->itemId = ValueObject\ItemId::fromString($itemId);
        $this->rating = new ValueObject\Rating($data['rating']);
    }

    public function getItemId(): ValueObject\ItemId
    {
        return $this->itemId;
    }

    public function getRating(): ValueObject\Rating
    {
        return $this->rating;
    }
}