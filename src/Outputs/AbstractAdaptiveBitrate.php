<?php

namespace Vimqu\Vimqu\Outputs;
use InvalidArgumentException;

abstract class AbstractAdaptiveBitrate extends AbstractOutput
{
    use HasClip, HasCrop, HasOverlayImage, HasTranscribe;

    protected array $variants = [];

    protected const ALLOWED_SCALES = ['240p', '480p', '720p', '1080p', '1440p', '2160p'];

    public function getTypeSpecificConfig(): array
    {
        $config = [
            'transcribe' => $this->transcribe,
            'filters' => [],
            'variants' => $this->variants
        ];

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

    /**
     * @param string $scale Resolution
     */
    public function addVariant(string $scale): self
    {
        if (in_array($scale, self::ALLOWED_SCALES, true) === false) {
            throw new InvalidArgumentException('Invalid scale: '. $scale);
        }

        $this->variants[] = [
            'scale' => $scale
        ];

        return $this;
    }
}