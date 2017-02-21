<?php

namespace Icewild\ImageOptimizer\Value;

class Dpi extends AbstractValue
{
    const AVAILABLE_DPI = [1,2,3];

    /**
     * @param string $value
     */
    public function validateValue(string $value): void
    {
        if (!in_array($value, static::AVAILABLE_DPI)) {
            throw new \InvalidArgumentException(sprintf('DPI [%s] not available', $value));
        }
    }
}
