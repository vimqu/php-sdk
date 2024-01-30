<?php

namespace Vimqu\Vimqu\Outputs;

trait HasOverlayImage
{
    protected ?array $overlayImage = null;

    /**
     * @param string $url URL of image
     * @param int $coordinateX Horizontal coordinate of overlay image
     * @param int $coordinateY Vertical  coordinate of overlay image
     * @param null|int $firstSecond The first second the picture will be shown
     * @param null|int $firstSecond The first second the picture will be shown
     */
    public function overlayImage(string $url, int $coordinateX = 1, int $coordinateY = 1, ?int $firstSecond = null, ?int $lastSecond = null): self
    {
        $this->overlayImage = [
            'url' => $url,
            'coordinate_x' => $coordinateX,
            'coordinate_y' => $coordinateY
        ];

        $this->overlayImage['between_seconds'] = sprintf('%s-%s', $firstSecond, $lastSecond);

        return $this;
    }
}