<?php

namespace Item\Domain\Model\Item\ValueObject;


use Assert\Assertion;

/**
 * Class ItemId
 * @package Item\Domain\Model\Item\ValueObject
 */
final class ItemId
{
    /**
     * @var string
     */
    private $id;

    /**
     * ItemId constructor.
     * @param string $id
     */
    private function __construct(string $id)
    {
        Assertion::uuid($id);
        $this->id = $id;
    }

    /**
     * @param string $id
     * @return ItemId
     */
    public static function fromString(string $id): ItemId
    {
        return new self($id);
    }

    /**
     * @return string
     */
    public function __toString(): string
    {
        return $this->id;
    }

    /**
     * @return string
     */
    public function toString(): string
    {
        return $this->__toString();
    }

}