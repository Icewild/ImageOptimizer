<?php

namespace Icewild\ImageOptimizer;

/**
 * Class ImageOptimizer
 * @package Icewild\ImageOptimizer
 */
class ImageOptimizer implements ImageOptimizerInterface
{
    protected $username;

    /**
     * ImageOptimizer constructor.
     * @param string $username
     */
    public function __construct(string $username)
    {
        $this->username = $username;
    }

    /**
     * @param string $path
     * @return AbstractImage
     */
    public function createFromFile(string $path): AbstractImage
    {
        return new ImageFile($this->username, $path);
    }

    /**
     * @param string $url
     * @return AbstractImage
     */
    public function createFromUrl(string $url): AbstractImage
    {
        return new ImageUrl($this->username, $url);
    }
}
