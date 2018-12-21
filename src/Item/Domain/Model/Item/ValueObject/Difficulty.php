<?php

namespace Item\Domain\Model\Item\ValueObject;

use Assert\Assertion;

/**
 * Class Difficulty
 * @package Item\Domain\Model\Item\ValueObject
 */
class Difficulty extends ValueObjectAbstract
{

    /**
     * @param $value
     */
    protected function set($value)
    {
        $value = trim($value);
        Assertion::numeric($value, 'Difficulty must be number');
        Assertion::inArray($value, ['1', '2', '3'], 'Difficulty value from 1 to 3');
        $this->value = $value;
    }

}