<?php

namespace Item\Domain\Model\Item;

use Item\Domain\Model\Item\ValueObject\Difficulty;
use Item\Domain\Model\Item\ValueObject\Name;
use Item\Domain\Model\Item\ValueObject\PropTime;
use Item\Domain\Model\Item\ValueObject\Rating;
use Item\Domain\Model\Item\ValueObject\ItemId;
use Item\Domain\Model\Item\ValueObject\Vegetarian;

/**
 * Class Item
 * @package Item\Domain\Model\Model
 */
class Item
{
    public function __construct(ItemId $itemId, Name $name, PropTime $propTime, Difficulty $difficulty, Vegetarian $vegetarian, array $ratings=[])
    {
        $this->setItemId($itemId);
        $this->setName($name);
        $this->setDifficulty($difficulty);
        $this->setPropTime($propTime);
        $this->setVegetarian($vegetarian);
        foreach ($ratings as $rating) {
            $this->addRating($rating);
        }
    }

    /**
     * @var
     */
    public $itemId;
    /**
     * @var
     */
    public $name;
    /**
     * @var
     */
    public $propTime;
    /**
     * @var
     */
    public $difficulty;
    /**
     * @var
     */
    public $vegetarian;
    /**
     * @var
     */
    public $ratings;

    /**
     * @return ItemId
     */
    public function getItemId(): ItemId
    {
        return $this->itemId;
    }

    /**
     * @param ItemId $itemId
     */
    public function setItemId(ItemId $itemId): void
    {
        $this->itemId = $itemId;
    }

    /**
     * @return Name
     */
    public function getName(): Name
    {
        return $this->name;
    }

    /**
     * @param Name $name
     */
    public function setName(Name $name): void
    {
        $this->name = $name;
    }

    /**
     * @return PropTime
     */
    public function getPropTime(): PropTime
    {
        return $this->propTime;
    }

    /**
     * @param PropTime $propTime
     */
    public function setPropTime(PropTime $propTime): void
    {
        $this->propTime = $propTime;
    }

    /**
     * @return Difficulty
     */
    public function getDifficulty(): Difficulty
    {
        return $this->difficulty;
    }

    /**
     * @param Difficulty $difficulty
     */
    public function setDifficulty(Difficulty $difficulty): void
    {
        $this->difficulty = $difficulty;
    }

    /**
     * @return Vegetarian
     */
    public function getVegetarian(): Vegetarian
    {
        return $this->vegetarian;
    }

    /**
     * @param Vegetarian $vegetarian
     */
    public function setVegetarian(Vegetarian $vegetarian): void
    {
        $this->vegetarian = $vegetarian;
    }


    /**
     * @return array
     */
    public function getRatings(): array
    {
        return $this->ratings ? $this->ratings  : [];
    }


    /**
     * @param Rating $rating
     */
    public function addRating(Rating $rating): void
    {
        $this->ratings[] = $rating;
    }

}