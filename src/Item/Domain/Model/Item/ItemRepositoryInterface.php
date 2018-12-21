<?php

namespace Item\Domain\Model\Item;

use Item\Domain\Model\Item\ValueObject\Rating;
use Item\Domain\Model\Item\ValueObject\ItemId;

/**
 * Interface ItemRepositoryInterface
 * @package Item\Domain\Model\Model
 */
interface ItemRepositoryInterface
{
    /**
     * @param null $query
     * @return array of Item objects
     */
    public function getAll(array $query = []): array;

    /**
     * @param ItemId $itemId
     * @return Item
     */
    public function getOneByItemId(ItemId $itemId): ?Item;

    /**
     * @param Item $item
     * @return void
     */
    public function create(Item $item): void;

    /**
     * @param Item $item
     */
    public function update(Item $item): void;

    /**
     * @param Item $item
     */
    public function remove(Item $item): void;

    /**
     * @param Item $item
     */
    public function rate(Item $item,Rating $rating): void;

    /**
     * @return ItemId
     */
    public function nextIdentity(): ItemId;
}
