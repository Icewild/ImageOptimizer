<?php

namespace Icewild\ImageOptimizer\Value;

abstract class AbstractValue
{
    protected $value;

    /**
     * AbstractValue constructor.
     * @param string $value
     */
    public function __construct(string $value)
    {
        $this->validateValue($value);

        $this->value = $value;
    }

    /**
     * @return string
     */
    public function getValue(): string
    {
        return $this->value;
    }

    /**
     * @param string $value
     */
    abstract public function validateValue(string $value): void;
}
