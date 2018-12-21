<?php

namespace Item\Infrastructure\Persistence\Doctrine;

use Doctrine\Common\Collections\ArrayCollection;

/**
 * @Entity
 * @Table(name="item")
 */
class Item
{

    /**
     * @Id
     * @GeneratedValue(strategy="NONE")
     * @Column(type="string")
     */
    private $itemId;

    /** @Column(type="string") */
    private $name;

    /** @Column(type="time") */
    private $propTime;

    /** @Column(type="integer") */
    private $difficulty;

    /** @Column(type="boolean") */
    private $vegetarian;

    /**
     * One product has many features. This is the inverse side.
     * @OneToMany(targetEntity="Rating", mappedBy="item", cascade={"ALL"})
     */
    private $ratings;

    public function __construct()
    {
        $this->ratings = new ArrayCollection();
    }

    /**
     * @return mixed
     */
    public function getItemId()
    {
        return $this->itemId;
    }

    /**
     * @param mixed $itemId
     */
    public function setItemId($itemId)
    {
        $this->itemId = $itemId;
    }

    /**
     * @return mixed
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param mixed $name
     */
    public function setName($name)
    {
        $this->name = $name;
    }

    /**
     * @return \DateTime
     */
    public function getPropTime()
    {
        return $this->propTime;
    }

    /**
     * @param mixed $propTime
     */
    public function setPropTime($propTime)
    {
        $this->propTime = $propTime;
    }

    /**
     * @return mixed
     */
    public function getDifficulty()
    {
        return $this->difficulty;
    }

    /**
     * @param mixed $difficulty
     */
    public function setDifficulty($difficulty)
    {
        $this->difficulty = $difficulty;
    }

    /**
     * @return mixed
     */
    public function getVegetarian()
    {
        return $this->vegetarian;
    }

    /**
     * @param mixed $vegetarian
     */
    public function setVegetarian($vegetarian)
    {
        $this->vegetarian = $vegetarian;
    }

    /**
     * @return mixed
     */
    public function getRatings()
    {
        return $this->ratings;
    }

    /**
     * @param mixed $ratings
     */
    public function addRating(Rating $rating)
    {
        $this->ratings[] = $rating;
    }

}
