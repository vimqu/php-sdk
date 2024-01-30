<?php

namespace Vimqu\Vimqu\Outputs;

trait HasCrop
{
    protected ?array $crop = null;

    /**
     * @param int $width Output video width
     * @param int $height Output video height
     * @param int $coordinateX Horizontal coordinate of input video
     * @param int $coordinateY Vertical coordinate of input video
     */
    public function crop(int $width = 1, int $height = 1, int $coordinateX = 1, int $coordinateY = 1): self
    {
        $this->crop = [
            'width' => $width,
            'height' => $height,
            'coordinate_x' => $coordinateX,
            'coordinate_y' => $coordinateY,
        ];

        return $this;
    }
}