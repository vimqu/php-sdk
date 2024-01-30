<?php

namespace Vimqu\Vimqu\Outputs;

use Vimqu\Vimqu\Enums\OutputTypeEnum;

class VideoOutput extends AbstractOutput
{
    use Resizable, HasOverlayImage, HasClip, HasCrop, HasSubtitle;

    private string $codec = 'h264';

    private string $container = 'mp4';

    /**
     * @param string $codec Available values: h264, h265, vp8, vp9, prores
     * @param string $container Available values: mp4, webm, mov, mkv
     */
    public function __construct(string $codec = 'h264', string $container = 'mp4')
    {
        $this->codec = $codec;
        $this->container = $container;
    }

    public function getType(): OutputTypeEnum
    {
        return OutputTypeEnum::VIDEO;
    }

    public function getTypeSpecificConfig(): array
    {
        $config = [
            'container' => $this->container,
            'codec' => $this->codec,
            'subtitles' => $this->subtitle,
            'filters' => []
        ];

        if (!empty($this->width) || !empty($this->height)) {
            $config['filters']['resize'] = [
                'width' => $this->width,
                'height' => $this->height,
                'aspect_ratio' => $this->aspectRatio
            ];
        }

        if (!empty($this->overlayImage)) {
            $config['filters']['overlay_image'] = $this->overlayImage;
        }

        if (!empty($this->clip)) {
            $config['filters']['clip'] = $this->clip;
        }

        if (!empty($this->crop)) {
            $config['filters']['crop'] = $this->crop;
        }

        return $config;
    }
}