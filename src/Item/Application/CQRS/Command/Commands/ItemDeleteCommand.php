<?php

namespace Item\Application\CQRS\Command\Commands;

use Item\Application\CQRS\Command\CommandInterface;
use Item\Domain\Model\Item\ValueObject;

class ItemDeleteCommand implements CommandInterface
{
    private $itemId;

    public function __construct(string $itemId)
    {
        $this->itemId = ValueObject\ItemId::fromString($itemId);

    }


    public function getItemId(): ValueObject\ItemId
    {
        return $this->itemId;
    }
}