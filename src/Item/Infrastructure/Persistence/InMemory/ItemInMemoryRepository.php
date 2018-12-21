<?php

namespace Item\Infrastructure\Persistence\InMemory;

use Ramsey\Uuid\Uuid;
use Item\Domain\Model\Item\Item;
use Item\Domain\Model\Item\ItemRepositoryInterface;
use Item\Domain\Model\Item\ValueObject\Rating;
use Item\Domain\Model\Item\ValueObject\ItemId;

class ItemInMemoryRepository implements ItemRepositoryInterface
{
    private $items = [];

    /**
     * @param null $query
     * @return array of Item objects
     */
    public function getAll(array $params = []): array
    {
        if ($params) {
            $return = [];
            foreach ($this->items as $item) {
                /* @var Item $item */
                $add = true;
                if (isset($params['name']) && $params['name']) {
                    $add = (strpos($item->getName()->get(), $params['name'].'') !== false);
                }
                if (isset($params['propTime']) && $params['propTime']) {
                    $add = $add && $item->getPropTime()->get() == $params['propTime'];
                }
                if (isset($params['difficulty']) && $params['difficulty']) {
                    $add = $add && $item->getDifficulty()->get() == $params['difficulty'];
                }
                if (isset($params['vegetarian']) && $params['vegetarian']) {
                    $params['vegetarian'] = $params['vegetarian']->get() ? true : false;
                    $add = $add && $item->getVegetarian()->get() == $params['vegetarian'];
                }
                if ($add) {
                    $return[] = $item;
                }
            }
            return $return;
        } else {
            return $this->items;
        }
    }

    /**
     * @param ItemId $itemId
     * @return Item
     */
    public function getOneByItemId(ItemId $itemId): ?Item
    {
        if (isset($this->items[$itemId->toString()])) {
            return $this->items[$itemId->toString()];
        }
        return null;
    }

    /**
     * @param Item $item
     * @return void
     */
    public function create(Item $item): void
    {
        $this->items[$item->getItemId()->toString()] = $item;
    }

    /**
     * @param Item $item
     */
    public function update(Item $item): void
    {
        $this->items[$item->getItemId()->toString()] = $item;

    }

    /**
     * @param Item $item
     */
    public function remove(Item $item): void
    {
        unset($this->items[$item->getItemId()->toString()]);
    }

    /**
     * @param Item $item
     */
    public function rate(Item $item, Rating $rating): void
    {
        $this->items[$item->getItemId()->toString()]->addRating($rating);
    }

    /**
     * @return ItemId
     */
    public function nextIdentity(): ItemId
    {
        return ItemId::fromString((string)Uuid::uuid4());
    }
}