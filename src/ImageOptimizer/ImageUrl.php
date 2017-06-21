<?php

namespace Icewild\ImageOptimizer;

class ImageUrl extends AbstractImage
{
    protected $url;

    /**
     * ImageUrl constructor.
     * @param string $username
     * @param string $url
     */
    public function __construct(string $username, string $url)
    {
        if (!filter_var($url, FILTER_VALIDATE_URL)) {
            throw new \InvalidArgumentException(sprintf(
                'Invalid url. Got [%s]',
                $url
            ));
        }

        $this->username = $username;
        $this->url = $url;
    }

    /**
     * @return bool|string
     */
    public function getBytes()
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
                $this->url
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
}