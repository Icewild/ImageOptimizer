<?php

namespace Icewild\ImageOptimizer;

use Icewild\ImageOptimizer\Value\Color;
use Icewild\ImageOptimizer\Value\Dpi;
use Icewild\ImageOptimizer\Value\Format;
use Icewild\ImageOptimizer\Value\Quality;
use Icewild\ImageOptimizer\Value\ResizeStrategy;

/**
 * Class ImageOptimizer
 * @package Icewild\ImageOptimizer
 */
class ImageOptimizer implements ImageOptimizerInterface
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
    protected $source_url;
    protected $timeout;

    /**
     * ImageOptimizer constructor.
     * @param string $username
     */
    public function __construct(string $username)
    {
        $this->username = $username;
    }

    /**
     * @param string $source_url
     * @return ImageOptimizerInterface
     */
    public function setSourceUrl(string $source_url): ImageOptimizerInterface
    {
        $this->source_url = $source_url;

        return $this;
    }

    /**
     * @param int $width
     * @param int|null $height
     * @return ImageOptimizerInterface
     */
    public function setWidthAndHeight(int $width, int $height = null): ImageOptimizerInterface
    {
        $this->width = $width;
        $this->height = $height;

        return $this;
    }

    /**
     * @param int $timeout
     * @return ImageOptimizerInterface
     */
    public function setTimeout(int $timeout): ImageOptimizerInterface
    {
        $this->timeout = $timeout;

        return $this;
    }

    /**
     * @param Dpi $dpi
     * @return ImageOptimizerInterface
     */
    public function setDpi(Dpi $dpi): ImageOptimizerInterface
    {
        $this->dpi = $dpi;

        return $this;
    }

    /**
     * @param Color $color
     * @return ImageOptimizerInterface
     */
    public function setBgColor(Color $color): ImageOptimizerInterface
    {
        $this->color = $color;

        return $this;
    }

    /**
     * @param Quality $quality
     * @return ImageOptimizerInterface
     */
    public function setQuality(Quality $quality): ImageOptimizerInterface
    {
        $this->quality = $quality;

        return $this;
    }

    /**
     * @param ResizeStrategy $resize_strategy
     * @return ImageOptimizerInterface
     */
    public function setResizeStrategy(ResizeStrategy $resize_strategy): ImageOptimizerInterface
    {
        $this->resize_strategy = $resize_strategy;

        return $this;
    }

    /**
     * @return string
     */
    public function getImage(): string
    {
        $params = [
            $this->getDpi(),
            $this->getColor(),
            $this->getQuality(),
            $this->getWidthAndHeight(),
            $this->getResizeStrategy(),
            $this->getTimeout(),
            $this->getFormat(),
        ];

        return file_get_contents(
            sprintf(
                '%s/%s/%s/%s',
                static::URL,
                $this->username,
                implode(',', array_filter($params)),
                $this->source_url
            ),
            false,
            stream_context_create(
                [
                    'http' => [
                        'method' => 'POST',
                    ],
                ]
            )
        );
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
        return $this->timeout ? sprintf('timeout=%s', $this->timeout) : null;
    }

    /**
     * @param Format $format
     * @return ImageOptimizerInterface
     */
    public function setFormat(Format $format): ImageOptimizerInterface
    {
        $this->format = $format;

        return $this;
    }

    /**
     * @return null|string
     */
    protected function getFormat(): ?string
    {
        return $this->format ? sprintf('format=%s', $this->format->getValue()) : null;
    }
}
