<?php

namespace Icewild\ImageOptimizer\Value;

class Quality extends AbstractValue
{
    const LOW_QUALITY = 'low';
    const MEDIUM_QUALITY = 'medium';
    const HIGH_QUALITY = 'high';
    const LOSSLESS_QUALITY = 'lossless';

    const AVAILABLE_QUALITY = [
        self::LOW_QUALITY => self::LOW_QUALITY,
        self::MEDIUM_QUALITY => self::MEDIUM_QUALITY,
        self::HIGH_QUALITY => self::HIGH_QUALITY,
        self::LOSSLESS_QUALITY => self::LOSSLESS_QUALITY,
    ];

    /**
     * @param string $value
     */
    public function validateValue(string $value): void
    {
        if (!array_key_exists($value, static::AVAILABLE_QUALITY)) {
            throw new \InvalidArgumentException(sprintf(
                'Available qualities are [%s]. Got [%s].',
                implode(', ', static::AVAILABLE_QUALITY),
                $value
            ));
        }
    }
}
