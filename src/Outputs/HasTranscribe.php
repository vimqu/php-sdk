<?php

namespace Vimqu\Vimqu\Outputs;

trait HasSubtitle
{
    protected bool $subtitle = false;

    public function subtitle(bool $subtitle): self
    {
        $this->subtitle = $subtitle;

        return $this;
    }
}