<?php

namespace Icewild\ImageOptimizer\Value;

class ResizeStrategy extends AbstractValue
{
    const STRATEGY_FIT = 'fit';
    const STRATEGY_CROP = 'crop';
    const STRATEGY_SCALE_DOWN = 'scale-down';
    const STRATEGY_PAD = 'pad';

    const AVAILABLE_STRATEGIES = [
        self::STRATEGY_FIT => self::STRATEGY_FIT,
        self::STRATEGY_PAD => self::STRATEGY_PAD,
        self::STRATEGY_CROP => self::STRATEGY_CROP,
        self::STRATEGY_SCALE_DOWN => self::STRATEGY_SCALE_DOWN,
    ];

    /**
     * @param string $value
     */
    public function validateValue(string $value): void
    {
        if (!array_key_exists($value, static::AVAILABLE_STRATEGIES)) {
            throw new \InvalidArgumentException(sprintf('Strategy [%s] is not available', $value));
        }
    }
}
