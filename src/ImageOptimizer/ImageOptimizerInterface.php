<?php

namespace Icewild\ImageOptimizer;

interface ImageOptimizerInterface
{
    /**
     * @param string $url
     * @return AbstractImage
     */
    public function createFromUrl(string $url): AbstractImage;

    /**
     * @param string $path
     * @return AbstractImage
     */
    public function createFromFile(string $path): AbstractImage;
}
