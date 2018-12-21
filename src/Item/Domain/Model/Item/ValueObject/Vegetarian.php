<?php

namespace Item\Domain\Model\Item\ValueObject;

use Assert\Assertion;

class Vegetarian extends ValueObjectAbstract implements ValueObjectInterface
{

    /**
     * @param $vegetarian
     */
    protected function set($vegetarian): void
    {
        Assertion::boolean($vegetarian,'Vegetarian must be boolean');
        $this->value = $vegetarian;
    }

}