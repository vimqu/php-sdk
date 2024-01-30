<?php

namespace Vimqu\Vimqu\Outputs;

trait Resizable
{
    protected ?int $width = null;

    protected ?int $height = null;

    protected ?bool $aspectRatio = true;

    /**
     * @param null|int $width
     * @param null|int $height
     * @param null|bool $aspectRatio
     */
    public function resize(?int $width = null, ?int $height = null, ?bool $aspectRatio = true): static
    {
        $this->width = $width;
        $this->height = $height;
        $this->aspectRatio = $aspectRatio;

        return $this;
    }
}