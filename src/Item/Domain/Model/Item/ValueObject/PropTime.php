<?php

namespace Item\Domain\Model\Item\ValueObject;

use Assert\Assertion;

/**
 * Class PropTime
 * @package Item\Domain\Model\Item\ValueObject
 */
class PropTime extends ValueObjectAbstract
{

    /**
     * @param $propTime
     */
    protected function set($propTime): void
    {
        $propTime = trim($propTime);
        Assertion::notBlank($propTime,'Prop Time can not be blank');
        Assertion::regex($propTime, "/^(?:2[0-4]|[01][1-9]|10):([0-5][0-9])$/", 'Time property must be in format 01:00 to 24:59');
        $this->value = $propTime;
    }

}