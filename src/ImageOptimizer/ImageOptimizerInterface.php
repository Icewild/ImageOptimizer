<?php

namespace Icewild\ImageOptimizer;

use Icewild\ImageOptimizer\Value\Color;
use Icewild\ImageOptimizer\Value\Dpi;
use Icewild\ImageOptimizer\Value\Format;
use Icewild\ImageOptimizer\Value\Quality;
use Icewild\ImageOptimizer\Value\ResizeStrategy;

interface ImageOptimizerInterface
{
    /**
     * ImageOptimizerInterface constructor.
     * @param string $username
     */
    public function __construct(string $username);

    public function getImage();

    /**
     * @param string $source_url
     * @return ImageOptimizerInterface
     */
    public function setSourceUrl(string $source_url): ImageOptimizerInterface;

    /**
     * @param int $width
     * @param int|null $height
     * @return ImageOptimizerInterface
     */
    public function setWidthAndHeight(int $width, int $height = null): ImageOptimizerInterface;

    /**
     * @param int $timeout
     * @return ImageOptimizerInterface
     */
    public function setTimeout(int $timeout): ImageOptimizerInterface;

    /**
     * @param Dpi $dpi
     * @return ImageOptimizerInterface
     */
    public function setDpi(Dpi $dpi): ImageOptimizerInterface;

    /**
     * @param Color $color
     * @return ImageOptimizerInterface
     */
    public function setBgColor(Color $color): ImageOptimizerInterface;

    /**
     * @param Quality $quality
     * @return ImageOptimizerInterface
     */
    public function setQuality(Quality $quality): ImageOptimizerInterface;

    /**
     * @param ResizeStrategy $resize_strategy
     * @return ImageOptimizerInterface
     */
    public function setResizeStrategy(ResizeStrategy $resize_strategy): ImageOptimizerInterface;

    /**
     * @param Format $format
     * @return ImageOptimizerInterface
     */
    public function setFormat(Format $format): ImageOptimizerInterface;
}
