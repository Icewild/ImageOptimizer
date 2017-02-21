<?php

namespace Icewild\ImageOptimizer\Value;

class Color extends AbstractValue
{
    /**
     * @param string $value
     */
    public function validateValue(string $value): void
    {
        if (!preg_match('/^(?:[0-9a-fA-F]{3}){1,2}$/i', $value)) {
            throw new \InvalidArgumentException(sprintf('String [%s] is not a hex color', $value));
        }
    }
}
