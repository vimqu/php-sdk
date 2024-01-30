<?php

namespace Vimqu\Vimqu\Outputs;

use Vimqu\Vimqu\Enums\OutputTypeEnum;

class ThumbnailByNumber extends AbstractOutput
{
    use Resizable;

    protected int $number;

    protected string $container;

    /**
     * @param int $number Count of requested thumbnail
     * @param ?string $container File format: jpg, png, webp
     */
    public function __construct(int $number, ?string $container = "jpg")
    {
        $this->number = $number;
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
            'number' => $this->number,
            'width' => $this->width,
            'height' => $this->height,
            'aspect_ratio' => $this->aspectRatio
        ];
    }
}