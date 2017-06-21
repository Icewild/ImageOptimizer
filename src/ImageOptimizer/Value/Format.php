<?php

namespace Icewild\ImageOptimizer\Value;

class Format extends AbstractValue
{
    const JPG_FORMAT = 'jpeg';
    const PNG_FORMAT = 'png';
    const WEBM_FORMAT = 'webm';

    const AVAILABLE_FORMAT_MAP = [
        self::JPG_FORMAT => self::JPG_FORMAT,
        self::PNG_FORMAT => self::PNG_FORMAT,
        self::WEBM_FORMAT => self::WEBM_FORMAT,
    ];

    /**
     * @param string $value
     */
    public function validateValue(string $value): void
    {
        if (!array_key_exists($value, static::AVAILABLE_FORMAT_MAP)) {
            throw new \InvalidArgumentException(sprintf(
                'Available formats are [%s]. Got [%s].',
                implode(', ', static::AVAILABLE_FORMAT_MAP),
                $value)
            );
        }
    }
}
