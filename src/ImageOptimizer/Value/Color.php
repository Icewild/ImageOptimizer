<?php

namespace Icewild\ImageOptimizer\Value;

class Color
{
    /** @var string */
    protected $color;

    /**
     * Color constructor.
     * @param string $color
     */
    public function __construct(string $color)
    {
        if (!preg_match('/^(?:[0-9a-fA-F]{3}){1,2}$/i', $color)) {
            throw new \InvalidArgumentException(sprintf('String [%s] is not a hex color', $color));
        }

        $this->color = $color;
    }

    /**
     * @return string
     */
    public function getValue()
    {
        return $this->color;
    }
}
