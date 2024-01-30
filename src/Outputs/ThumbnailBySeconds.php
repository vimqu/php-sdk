<?php

namespace Vimqu\Vimqu\Outputs;

use Vimqu\Vimqu\Enums\OutputTypeEnum;

class ThumbnailBySeconds extends AbstractOutput
{
    use Resizable;

    protected array $seconds;

    protected string $container;

    /**
     * @param int $number Count of requested thumbnail
     * @param ?string $container File format: jpg, png, webp
     */
    public function __construct(array $seconds, ?string $container = "jpg")
    {
        foreach($seconds as $second) {
            if (is_int($second) === false) {
                throw new \InvalidArgumentException('Invalid second : ' . $second);
            }
            $this->seconds[] = $second;
        }

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
            'exact_seconds' => $this->seconds,
            'width' => $this->width,
            'height' => $this->height,
            'aspect_ratio' => $this->aspectRatio
        ];
    }
}