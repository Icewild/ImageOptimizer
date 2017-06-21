<?php

namespace Icewild\ImageOptimizer\Value;

class Timeout extends AbstractValue
{
    /**
     * @param string $value
     */
    public function validateValue(string $value): void
    {
        if (!is_numeric($value) && $value <= 0) {
            throw new \InvalidArgumentException(sprintf(
                'Timeout is not a positive number. Got [%s].',
                $value
            ));
        }
    }
}
