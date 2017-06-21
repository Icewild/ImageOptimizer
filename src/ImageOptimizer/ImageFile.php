<?php

namespace Icewild\ImageOptimizer;

class ImageFile extends AbstractImage
{
    protected $path;

    /**
     * ImageFile constructor.
     * @param string $username
     * @param string $path
     */
    public function __construct(string $username, string $path)
    {
        if (!file_exists($path)) {
            throw new \InvalidArgumentException(sprintf(
                'File does not exist. Got path [%s].',
                $path
            ));
        }

        $this->path = $path;
        $this->username = $username;
    }

    public function getBytes()
    {

    }
}
