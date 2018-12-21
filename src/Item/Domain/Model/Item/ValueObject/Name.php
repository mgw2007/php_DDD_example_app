<?php

namespace Item\Domain\Model\Item\ValueObject;

use Assert\Assertion;


/**
 * Class Name
 * @package Item\Domain\Model\Item\ValueObject
 */
class Name extends ValueObjectAbstract
{

    /**
     * @param $name
     */
    protected function set($name): void
    {
        Assertion::notBlank($name,'Name can not be blank');
        $this->value = $name;
    }
}