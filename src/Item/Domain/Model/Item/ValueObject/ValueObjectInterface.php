<?php


namespace Item\Domain\Model\Item\ValueObject;

/**
 * Interface ValueObjectInterface
 * @package Item\Domain\Model\Item\ValueObject
 */
interface ValueObjectInterface
{

    /**
     * ValueObjectInterface constructor.
     * @param $value
     */
    public function __construct($value);

    /**
     * @return mixed
     */
    public function get();

}