<?php

namespace Vimqu\Vimqu\Outputs;

use Vimqu\Vimqu\Enums\OutputTypeEnum;

class ThumbnailByInterval extends AbstractOutput
{
    use Resizable;

    protected int $interval;

    protected string $container;

    /**
     * @param int $number Count of requested thumbnail
     * @param ?string $container File format: jpg, png, webp
     */
    public function __construct(int $interval, ?string $container = "jpg")
    {
        $this->interval = $interval;
        $this->container = $container;
    }

    public function getType(): OutputTypeEnum
    {
        return OutputTypeEnum::THUMBNAIL;
    }

    public function getTypeSpecificConfig(): array
    {
        return [
            'container' => $this->container,
            'interval' => $this->interval,
            'width' => $this->width,
            'height' => $this->height,
            'aspect_ratio' => $this->aspectRatio
        ];
    }
}