<?php

namespace Item\Application\CQRS\Query\Queries;

use Item\Domain\Model\Item\ValueObject;

use Item\Application\CQRS\Query\QueryInterface;

class GetOneItemQuery implements QueryInterface
{
    private $id;

    public function __construct($itemId)
    {
        $this->id = ValueObject\ItemId::fromString($itemId);
    }

    /**
     * @return ItemId
     */
    public function getItemId(): ValueObject\ItemId
    {
        return $this->id;
    }
}