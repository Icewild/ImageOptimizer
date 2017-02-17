<?php

namespace Icewild\ImageOptimizer\Value;

class Quality
{
    protected $quality;

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
     * Quality constructor.
     * @param string $quality
     */
    public function __construct(string $quality)
    {
        if (!array_key_exists($quality, static::AVAILABLE_QUALITY)) {
            throw new \InvalidArgumentException(sprintf('Quality [%s] is not available', $quality));
        }

        $this->quality = $quality;
    }

    /**
     * @return string
     */
    public function getValue()
    {
        return $this->quality;
    }
}
