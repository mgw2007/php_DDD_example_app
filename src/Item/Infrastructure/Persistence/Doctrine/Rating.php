<?php

namespace Item\Infrastructure\Persistence\Doctrine;


/**
 * @Entity
 * @Table(name="rating")
 */
class Rating
{
    /**
     * @Id
     * @GeneratedValue(strategy="AUTO")
     * @Column(type="integer")
     */
    private $id;

    /** @Column(type="integer") */
    private $value;

    /**
     * Many features have one product. This is the owning side.
     * @ManyToOne(targetEntity="Item", inversedBy="ratings")
     * @JoinColumn(name="itemId", referencedColumnName="itemId")
     */
    private $item;


    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @param int $id
     */
    public function setId(int $id)
    {
        $this->id = $id;
    }

    /**
     * @return mixed
     */
    public function getValue()
    {
        return $this->value;
    }

    /**
     * @param mixed $value
     */
    public function setValue($value)
    {
        $this->value = $value;
    }


    /**
     * @return Item
     */
    public function getItem(): Item
    {
        return $this->item;
    }

    /**
     * @param Item $item
     */
    public function setItem(Item $item): void
    {
        $this->item = $item;
    }


}
