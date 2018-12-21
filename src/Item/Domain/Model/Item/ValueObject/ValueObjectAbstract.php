<?php


namespace Item\Domain\Model\Item\ValueObject;

abstract class ValueObjectAbstract implements ValueObjectInterface
{
    protected $value;

    public function __construct($value)
    {
        $this->set($value);
    }

    abstract protected function set($value);

    public function get()
    {
        return $this->value;
    }

    public function __toString()
    {
        return $this->get();
    }
    public function toString()
    {
        return $this->__toString();
    }


}