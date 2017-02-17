<?php

namespace Icewild\ImageOptimizer\Value;

class Dpi
{
    /** @var int */
    protected $dpi;

    const AVAILABLE_DPI = [1,2,3];

    /**
     * Dpi constructor.
     * @param int $dpi
     */
    public function __construct(int $dpi)
    {
        if (!in_array($dpi, static::AVAILABLE_DPI)) {
            throw new \InvalidArgumentException(sprintf('DPI [%s] not available', $dpi));
        }

        $this->dpi = $dpi;
    }

    /**
     * @return int
     */
    public function getValue(): int
    {
        return $this->dpi;
    }
}
