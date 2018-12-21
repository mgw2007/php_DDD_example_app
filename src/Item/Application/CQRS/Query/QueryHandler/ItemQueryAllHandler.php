<?php

namespace Item\Application\CQRS\Query\QueryHandler;


use Item\Application\CQRS\Query\QueryHandlerInterface;
use Item\Application\CQRS\Query\QueryInterface;
use Item\Domain\Model\Item\ItemRepositoryInterface;
use Item\Domain\Model\Item\ValueObject;

class ItemQueryAllHandler implements QueryHandlerInterface
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
        $findArray = [];
        foreach ($query->getQueryParameters() as $key => $value) {
            switch ($key) {
                case 'name':
                    $value = new ValueObject\Name($value);
                    break;
                case 'propTime':
                    $value = new ValueObject\PropTime($value);
                    break;
                case 'difficulty':
                    $value = new ValueObject\Difficulty($value);
                    break;
                case 'vegetarian':
                    $value = new ValueObject\Vegetarian(in_array($value, [1, 'true']));
                    break;
                default:
                    throw new \Exception("Param $key not available");
            }
            $findArray[$key] = $value;
        }

        $rows = $this->repository->getAll($findArray);

        return array_map(function ($row) {
            return [
                'id'         => $row->getItemId()->toString(),
                'name'       => $row->getName()->toString(),
                'propTime'   => $row->getPropTime()->toString(),
                'difficulty' => $row->getDifficulty()->toString(),
                'vegetarian' => $row->getVegetarian()->toString(),
                'ratings'    => array_map(function ($rate) {
                    return $rate->toString();
                }, $row->getRatings()),
            ];
        }, $rows);


    }

}