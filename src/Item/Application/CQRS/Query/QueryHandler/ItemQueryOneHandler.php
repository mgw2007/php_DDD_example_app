<?php

namespace Item\Application\CQRS\Query\QueryHandler;


use Assert\Assertion;
use Item\Application\CQRS\Query\QueryHandlerInterface;
use Item\Application\CQRS\Query\QueryInterface;
use Item\Domain\Model\Item\ItemRepositoryInterface;

class ItemQueryOneHandler implements QueryHandlerInterface
{
    /*
    * @var ItemRepositoryInterface
    */
    private $repository;

    public function __construct(ItemRepositoryInterface $repository)
    {
        $this->repository = $repository;
    }


    public function query(QueryInterface $query): array
    {
        $item = $this->repository->getOneByItemId($query->getItemId());
        Assertion::notEmpty($item,'Item not exist');

        return [
            'id'         => $item->getItemId()->toString(),
            'name'       => $item->getName()->toString(),
            'propTime'   => $item->getPropTime()->toString(),
            'difficulty' => $item->getDifficulty()->toString(),
            'vegetarian' => $item->getVegetarian()->toString(),
            'ratings'    => array_map(function ($rate) {
                return $rate->toString();
            }, $item->getRatings()),
        ];

    }

}