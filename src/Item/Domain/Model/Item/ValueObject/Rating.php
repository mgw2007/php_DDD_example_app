<?php

namespace Item\Domain\Model\Item\ValueObject;

use Assert\Assertion;

/**
 * Class Rating
 * @package Item\Domain\Model\Item\ValueObject
 */
class Rating extends ValueObjectAbstract
{

    /**
     * @param $rating
     */
    protected function set($rating): void
    {
        $rating = trim($rating);

        Assertion::numeric($rating, 'Rating must be number');
        Assertion::inArray($rating, ['1', '2', '3', '4', '5'], 'Rating value from 1 to 5');
        $this->value = $rating;
    }

}