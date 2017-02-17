<?php

namespace Icewild\ImageOptimizer\Value;

class Format
{
    /** @var int */
    protected $format;

    const JPG_FORMAT = 'jpeg';
    const PNG_FORMAT = 'png';
    const WEBM_FORMAT = 'webm';

    const AVAILABLE_FORMAT_MAP = [
        self::JPG_FORMAT => self::JPG_FORMAT,
        self::PNG_FORMAT => self::PNG_FORMAT,
        self::WEBM_FORMAT => self::WEBM_FORMAT,
    ];

    /**
     * Format constructor.
     * @param string $format
     */
    public function __construct(string $format)
    {
        if (!array_key_exists($format, static::AVAILABLE_FORMAT_MAP)) {
            throw new \InvalidArgumentException(sprintf('Format [%s] not available', $format));
        }

        $this->format = $format;
    }

    /**
     * @return int
     */
    public function getValue()
    {
        return $this->format;
    }
}
