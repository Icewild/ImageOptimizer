<?php

namespace Icewild\ImageOptimizer;

use Icewild\ImageOptimizer\Value\Color;
use Icewild\ImageOptimizer\Value\Dpi;
use Icewild\ImageOptimizer\Value\Format;
use Icewild\ImageOptimizer\Value\Quality;
use Icewild\ImageOptimizer\Value\ResizeStrategy;
use Icewild\ImageOptimizer\Value\Timeout;

abstract class AbstractImage
{
    const URL = 'https://im2.io';

    protected $username;
    /** @var Dpi */
    protected $dpi;
    /** @var Color */
    protected $color;
    /** @var Quality */
    protected $quality;
    /** @var ResizeStrategy */
    protected $resize_strategy;
    /** @var Format */
    protected $format;
    protected $width;
    protected $height;
    /** @var Timeout */
    protected $timeout;

    /**
     * @param Format $format
     * @return AbstractImage
     */
    public function setFormat(Format $format): AbstractImage
    {
        $this->format = $format;

        return $this;
    }

    /**
     * @param int $width
     * @param int|null $height
     * @return AbstractImage
     */
    public function setWidthAndHeight(int $width, int $height = null): AbstractImage
    {
        if ($width <= 0 || $width > 10000) {
            throw new \InvalidArgumentException(sprintf(
                'Width should be between 0 and 10000. Got [%s]',
                $width
            ));
        }

        if ($height && ($height <= 0 || $height > 10000)) {
            throw new \InvalidArgumentException(sprintf(
                'Height should be between 0 and 10000. Got [%s]',
                $height
            ));
        }

        $this->width = $width;
        $this->height = $height;

        return $this;
    }

    /**
     * @param Timeout $timeout
     * @return AbstractImage
     */
    public function setTimeout(Timeout $timeout): AbstractImage
    {
        $this->timeout = $timeout;

        return $this;
    }

    /**
     * @param Dpi $dpi
     * @return AbstractImage
     */
    public function setDpi(Dpi $dpi): AbstractImage
    {
        $this->dpi = $dpi;

        return $this;
    }

    /**
     * @param Color $color
     * @return AbstractImage
     */
    public function setBgColor(Color $color): AbstractImage
    {
        $this->color = $color;

        return $this;
    }

    /**
     * @param Quality $quality
     * @return AbstractImage
     */
    public function setQuality(Quality $quality): AbstractImage
    {
        $this->quality = $quality;

        return $this;
    }

    /**
     * @param ResizeStrategy $resize_strategy
     * @return AbstractImage
     */
    public function setResizeStrategy(ResizeStrategy $resize_strategy): AbstractImage
    {
        $this->resize_strategy = $resize_strategy;

        return $this;
    }

    /**
     * @return null|string
     */
    protected function getDpi(): ?string
    {
        return $this->dpi ? sprintf('%sx', $this->dpi->getValue()) : null;
    }

    /**
     * @return null|string
     */
    protected function getColor(): ?string
    {
        return $this->color ? sprintf('bgcolor=%s', $this->color->getValue()) : null;
    }

    /**
     * @return null|string
     */
    protected function getQuality(): ?string
    {
        return $this->quality ? sprintf('quality=%s', $this->quality->getValue()) : null;
    }

    /**
     * @return null|string
     */
    protected function getWidthAndHeight(): ?string
    {
        if ($this->height) {
            return sprintf('%sx%s', $this->width, $this->height);
        } else {
            return $this->width ?: null;
        }
    }

    /**
     * @return null|string
     */
    protected function getResizeStrategy(): ?string
    {
        return $this->resize_strategy ? $this->resize_strategy->getValue() : null;
    }

    /**
     * @return null|string
     */
    protected function getTimeout(): ?string
    {
        return $this->timeout ? sprintf('timeout=%s', $this->timeout->getValue()) : null;
    }

    /**
     * @return null|string
     */
    protected function getFormat(): ?string
    {
        return $this->format ? sprintf('format=%s', $this->format->getValue()) : null;
    }

    /**
     * @return string
     */
    protected function doGetBytes()
    {
        $this->validate();

        return $this->getBytes();
    }

    public function validate(): void
    {
    }

    abstract public function getBytes();
}