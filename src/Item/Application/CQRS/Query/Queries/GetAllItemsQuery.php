<?php

namespace Item\Application\CQRS\Query\Queries;

use Item\Domain\Model\Item\ValueObject;

use Item\Application\CQRS\Query\QueryInterface;

class GetAllItemsQuery implements QueryInterface
{
    private $queryParameters;

    public function __construct($queryParamters = [])
    {
        $this->queryParameters = $queryParamters;
    }

    /**
     * @return ItemId
     */
    public function getQueryParameters(): array
    {
        return $this->queryParameters;
    }
}