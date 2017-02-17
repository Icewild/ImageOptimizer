<?php

namespace Icewild\ImageOptimizer\Value;

class ResizeStrategy
{
    protected $resize_strategy;

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
     * ResizeStrategy constructor.
     * @param string $resize_strategy
     */
    public function __construct(string $resize_strategy)
    {
        if (!array_key_exists($resize_strategy, static::AVAILABLE_STRATEGIES)) {
            throw new \InvalidArgumentException(sprintf('Strategy [%s] is not available', $resize_strategy));
        }

        $this->resize_strategy = $resize_strategy;
    }

    /**
     * @return string
     */
    public function getValue()
    {
        return $this->resize_strategy;
    }
}
